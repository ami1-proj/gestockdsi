<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Statut;
use App\Employe;
use App\Phonenum;
use App\Fournisseur;
use Mockery\Generator\StringManipulation\Pass\CallTypeHintPass;

trait PhonenumTrait {

    /**
     * Cree un nouveau numero et l'associe à un element (Fournissur ou CallTypeHintPass)
     * @param  int   $numero    Numero ede telephone
     * @param  string   $elem_type Type d element (fournisseur, employe)
     * @param  int   $elem_id   id de l element
     * @return Phonenum            Le nouveau numero de telephone
     */
    public function createNewPhonenum($numero, $elem_type, $elem_id) : Phonenum
    {
        $default_statut =  Statut::default()->first();

        if (empty($numero)) {
          return null;
        }

        // if (!(is_numeric($numero))) {
        //   return null;
        // }

        $phonenum = Phonenum::create([
          'numero' => $numero,
          'statut_id' => $default_statut->id,
        ]);

        $elem = $this->getElemPhonenum($elem_type, $elem_id);

        $elem->phonenums()->attach($phonenum->id, ['rang' => ($elem->phonenums_count + 1)]);

        return $phonenum;
    }

    /**
     * Deplece le numero d'un element (fournisseur, employe) vers le haut
     * @param  int   $phonenum_id id du telephone
     * @param  string   $elem_type   type d element (fournisseur, employe)
     * @param  int   $elem_id     id de l element
     * @return Phonenum              Le numero de telephone modifie
     */
    public function moveUpPhonenum($phonenum_id, $elem_type, $elem_id) : Phonenum
    {
        $elem = $this->getElemPhonenum($elem_type, $elem_id);

        $phonenum = $elem->phonenums()->where('phonenum_id', $phonenum_id)->first();

        if ($phonenum->pivot->rang > 1) {
            // On switch les position
            $this->switchRangPhonenum($elem, ($phonenum->pivot->rang - 1), $phonenum->pivot->rang);
            // On affecte la nouvelle position
            $elem->phonenums()->updateExistingPivot($phonenum_id, ['rang' => ($phonenum->pivot->rang - 1) ]);
        }

        return $phonenum;
    }

    /**
   * Deplace le numero de telephone d'un element (fournisseur, employe) vers le bas
     * @param  int   $phonenum_id id du numero de telephone
     * @param  string   $elem_type   type d element (fournisseur, employe)
     * @param  int   $elem_id     id de l element
     * @return Phonenum              Le numero de telephone modifie
     */
    public function moveDownPhonenum($phonenum_id, $elem_type, $elem_id) : Phonenum
    {
        $elem = $this->getElemPhonenum($elem_type, $elem_id);
        $phonenum = $elem->phonenums()->where('phonenum_id', $phonenum_id)->first();

        if ($phonenum->pivot->rang < $elem->phonenums_count) {
            // On switch les position
            $this->switchRangPhonenum($elem, ($phonenum->pivot->rang + 1), $phonenum->pivot->rang);
            // On affecte la nouvelle position
            $elem->phonenums()->updateExistingPivot($phonenum_id, ['rang' => ($phonenum->pivot->rang + 1) ]);
        }
        return $phonenum;
    }

    /**
   * Supprime le telephone d un element (fournisseur, employe)
     * @param  integer $phonenum_id id du telephonz
     * @param  string $elem_type   type d element (fournieeur, employe)
     * @param  integer $elem_id     id de l element
     * @return int                 code representant le resultat de l'operartion
     */
    public function deletePhonenum($phonenum_id, $elem_type, $elem_id) : int
    {
        $phonenum = Phonenum::find($phonenum_id);

        $elem = $this->getElemPhonenum($elem_type, $elem_id);

        $elem->phonenums()->detach($phonenum->id);
        $this->reorganiseRangsPhonenum($elem);

        return 1;
    }

    /**
     * Modifie le rangs d un telephone
     * @param  Employe/Fornisseur $elem     l element a gerer
     * @param  int $old_rang ancien rang
     * @param  int $new_rang nouveau rang
     * @return int              code du resultat de l operation
     */
    private function switchRangPhonenum($elem, $old_rang, $new_rang) : int
    {
        $phonenum_to_switch = $elem->phonenums()->where('rang', $old_rang)->first();
        $elem->phonenums()->updateExistingPivot($phonenum_to_switch->id, ['rang' => ($new_rang) ]);

        return 1;
    }

    /**
     * Reorganise les rangs des telephone d un element
     * @param  Employe/Fournisseur $elem l element dont il faut reorganiser les rangs
     * @return int          code representant le resultat de l operation
     */
    private function reorganiseRangsPhonenum($elem) : int
    {
        $rang = 1;
        foreach ($elem->phonenums as $phonenum) {
            $elem->phonenums()->updateExistingPivot($phonenum->id, [ 'rang' => $rang ]);
            $rang++;
        }

        return 1;
    }

    /**
     * Retourne l element a gerer
     * @param  string $elem_type le nom de l element (employe, fournisseur)
     * @param  int $elem_id   id de l element
     * @return Employe/Fournisseur            l element
     */
    private function getElemPhonenum($elem_type, $elem_id)
    {
        if ($elem_type == 'employe') {
            // ajout de withCount('phonenums') permet de rajouter dans l objet obtenu le nombre de telephones lies
            $elem = Employe::withCount('phonenums')->find($elem_id);
        } else {
            $elem = Fournisseur::withCount('phonenums')->find($elem_id);
        }

        return $elem;
    }

}
