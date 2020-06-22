<?php

namespace App\Traits;
use App\Employe;
use App\Fournisseur;
use App\Adresseemail;
use App\Statut;

trait AdresseemailTrait {

    /**
     * Cree une nouvelle adresse e-mail et l'associe à un element (Fournissur ou Employe)
     * @param  int   $email    Numero ede telephone
     * @param  string   $elem_type Type d element (fournisseur, employe)
     * @param  int   $elem_id   id de l element
     * @return Adresseemail            Le nouveau numero de telephone
     */
    public function createNewAdresseemail($email, $elem_type, $elem_id) : Adresseemail
    {
        if (empty($email)) {
          return null;
        }

        $adresseemail = Adresseemail::create([
          'email' => $email,
          'statut_id' => Statut::actif()->first()->id,
        ]);

        $elem = $this->getElemAdresseemail($elem_type, $elem_id);

        $elem->adresseemails()->attach($adresseemail->id, ['rang' => ($elem->adresseemails_count + 1)]);

        return $adresseemail;
    }

    /**
     * Deplece le numero d'un element (fournisseur, employe) vers le haut
     * @param  int   $adresseemail_id id de l email
     * @param  string   $elem_type   type d element (fournisseur, employe)
     * @param  int   $elem_id     id de l element
     * @return Adresseemail              L email modifie
     */
    public function moveUpAdresseemail($adresseemail_id, $elem_type, $elem_id) : Adresseemail
    {
        $elem = $this->getElemAdresseemail($elem_type, $elem_id);

        $adresseemail = $elem->adresseemails()->where('adresseemail_id', $adresseemail_id)->first();

        if ($adresseemail->pivot->rang > 1) {
            // On switch les position
            $this->switchRangAdresseemail($elem, ($adresseemail->pivot->rang - 1), $adresseemail->pivot->rang);
            // On affecte la nouvelle position
            $elem->adresseemails()->updateExistingPivot($adresseemail_id, ['rang' => ($adresseemail->pivot->rang - 1) ]);
        }

        return $adresseemail;
    }

    /**
   * Deplace l email d'un element (fournisseur, employe) vers le bas
     * @param  int   $adresseemail_id id de l email
     * @param  string   $elem_type   type d element (fournisseur, employe)
     * @param  int   $elem_id     id de l element
     * @return Adresseemail              L email modifie
     */
    public function moveDownAdresseemail($adresseemail_id, $elem_type, $elem_id) : Adresseemail
    {
        $elem = $this->getElemAdresseemail($elem_type, $elem_id);
        $adresseemail = $elem->adresseemails()->where('adresseemail_id', $adresseemail_id)->first();

        if ($adresseemail->pivot->rang < $elem->adresseemails_count) {
            // On switch les position
            $this->switchRangAdresseemail($elem, ($adresseemail->pivot->rang + 1), $adresseemail->pivot->rang);
            // On affecte la nouvelle position
            $elem->adresseemails()->updateExistingPivot($adresseemail_id, ['rang' => ($adresseemail->pivot->rang + 1) ]);
        }
        return $adresseemail;
    }

    /**
   * Supprime l email d un element (fournisseur, employe)
     * @param  integer $adresseemail_id id du telephonz
     * @param  string $elem_type   type d element (fournieeur, employe)
     * @param  integer $elem_id     id de l element
     * @return int                 code representant le resultat de l'operartion (0: il ne s est rien passe; 1: tout est OK; -1: c est le dernier)
     */
    public function deleteAdresseemail($adresseemail_id, $elem_type, $elem_id) : int
    {
        $adresseemail = Adresseemail::find($adresseemail_id);

        $elem = $this->getElemAdresseemail($elem_type, $elem_id);
        $rslt = 0;

        if ($elem->adresseemails_count > 1) {
            $elem->adresseemails()->detach($adresseemail->id);
            $this->reorganiseRangsAdresseemail($elem);

            $rslt = 1;
        } else {
            $rslt = -1;
        }

        return $rslt;
    }

    /**
     * Modifie le rangs d un email
     * @param  Employe/Fornisseur $elem     l element a gerer
     * @param  int $old_rang ancien rang
     * @param  int $new_rang nouveau rang
     * @return int              code du resultat de l operation
     */
    private function switchRangAdresseemail($elem, $old_rang, $new_rang) : int
    {
        $adresseemail_to_switch = $elem->adresseemails()->where('rang', $old_rang)->first();
        $elem->adresseemails()->updateExistingPivot($adresseemail_to_switch->id, ['rang' => ($new_rang) ]);

        return 1;
    }

    /**
     * Reorganise les rangs des emails d un element
     * @param  Employe/Fournisseur $elem l element dont il faut reorganiser les rangs
     * @return int          code representant le resultat de l operation
     */
    private function reorganiseRangsAdresseemail($elem) : int
    {
        $rang = 1;
        foreach ($elem->adresseemails as $adresseemail) {
            $elem->adresseemails()->updateExistingPivot($adresseemail->id, [ 'rang' => $rang ]);
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
    private function getElemAdresseemail($elem_type, $elem_id)
    {
        if ($elem_type == 'employe') {
            // ajout de withCount('adresseemails') permet de rajouter dans l objet obtenu le nombre d emails lies
            $elem = Employe::withCount('adresseemails')->find($elem_id);
        } else {
            $elem = Fournisseur::withCount('adresseemails')->find($elem_id);
        }

        return $elem;
    }

}
