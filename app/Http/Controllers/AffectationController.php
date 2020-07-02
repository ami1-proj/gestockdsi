<?php

namespace App\Http\Controllers;

use App\Affectation;
use Illuminate\Http\Request;

use App\Traits\AffectationTrait;
use App\TypeMouvement;
use App\Article;
use App\TypeAffectation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use PDF;


class AffectationController extends Controller
{
    use AffectationTrait;

    function __construct()
    {
         $this->middleware('permission:affectation-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'objet'];
        $recherche_cols_val = ['id' => 'id', 'objet' => 'objet'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $recherche_cols_val[$request->query('sortBy')];
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $affectations = Affectation::search($q)->where('tags', 'NOT LIKE', "%Systeme%")->OrWhereNull('tags')->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('affectations.index', compact('affectations', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function show(Affectation $affectation)
    {
        //dd($affectation);
        $affectation = Affectation::with(['statut','affectationarticles'])->where('id', $affectation->id)->first();

        //dd('relations', $affectation->relationships(), 'sub children', $affectation->subChildrenRelations());
        $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->beneficiaire->id);

        return view('affectations.show', ['affectation' => $affectation, 'elem_arr' => $elem_arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Affectation $affectation)
    {
        $affectation = Affectation::with(['statut','affectationarticles','typeAffectation'])->where('id', $affectation->id)->first();
        $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->beneficiaire->id);

        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id');//->toArray();
        $selectedarticles = $affectation->articles()->pluck('reference_complete', 'id');

        $nowdate = Carbon::now();

        return view('affectations.edit')
          ->with('articles', $articles_disponibles)
          ->with('selectedarticles', $selectedarticles)
          ->with('elem_arr', $elem_arr)
          ->with('nowdate', $nowdate)
          ->with('affectation', $affectation)
          ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affectation $affectation)
    {
        $type_mouvement = TypeMouvement::modification()->first();//->pluck('libelle', 'id');
        $request->merge([
            'type_mouvement_id' => $type_mouvement->id,
        ]);

        // Validate the form
        $request->validate(Affectation::updateRules($affectation));

        $formInput = $request->all();

        /*$liste_article_a_retirer = Article::join("affectation_article","affectation_article.article_id","=","articles.id")
            ->where("affectation_article.affectation_id", $affectation->id)
            ->get()
            ->pluck('article_id')->toArray();*/

        $articles_a_affecter = $formInput['articles'];
        $type_mouvement_id = $type_mouvement->id;//$formInput['type_mouvement_id'];
        $details = $formInput['details'];
        //$elem_id = $formInput['elem_id'];

        // Retrait des entrees non contenues dans la table affectation
        $formInput = $this->formatRequestInput($formInput);

        $upd_rst = $this->updateOne($affectation->id, $formInput, $type_mouvement_id, $details, $articles_a_affecter);

        // Sessions Message
        if ($upd_rst == 1) {
          $request->session()->flash('msg_success',__('messages.affectationUpdated', ['affectationtype' => $affectation->typeAffectation->libelle] ));
        } else {
          $request->session()->flash('msg_danger',__('messages.affectationCantBeEmpty'));
        }

        $show_controller = $affectation->typeAffectation->tags . 'Controller@' . 'show';

        return redirect()->action($show_controller, $affectation->beneficiaire->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affectation $affectation)
    {
        $type_affectation = TypeAffectation::find($affectation->type_affectation_id);
        $this->deleteOne($affectation->id);

        // Sessions Message
        session()->flash('msg_success',__('messages.affectationDeleted', ['affectationtype' => $type_affectation->libelle] ));

        $show_controller = $affectation->typeAffectation->tags . 'Controller@' . 'show';

        return redirect()->action($show_controller, $affectation->beneficiaire->id);
    }

    public function elemcreate($type_affectation_tag, $elem_id)
    {
        $q = null;
        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);
        $articles = Article::disponibles()->get()->pluck('reference_complete', 'id')->toArray();
        $nowdate = Carbon::now();
        $affectation = $this->getDefaultObject(new Affectation());

        return view('affectations.create')
            ->with('affectation', $affectation)
            ->with('articles', $articles)
            ->with('type_affectation', $type_affectation)
            ->with('elem_arr', $elem_arr)
            ->with('nowdate', $nowdate)
            ;
    }

    public function elemstore(Request $request, $type_affectation_tag, $elem_id)
    {
        // Validate the form
        $request->validate(Affectation::createRules());

        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();

        $formInput = $request->all();
        $articles_a_affecter = $formInput['articles'];

        $newaffectation = $this->createNew($formInput['objet'], $formInput['date_debut'], $type_affectation_tag, $elem_id ,$articles_a_affecter);

        if (! $newaffectation) {
            $request->session()->flash('msg_danger',__('messages.erreurInattendue' ));
            return redirect()->back();
        }

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.affectationCreated', ['affectationtype' => $type_affectation->libelle] ));

        //notifierBeneficiaire
        $newaffectation->notifierBeneficiaire();
        $newaffectation->notifierAdminFoncs();

        $show_controller = 'AffectationController@show';

        return redirect()->action($show_controller, $newaffectation->id);

    }

    // Affectations Elem
    public function elemcreate_save20200701($type_affectation_tag, $elem_id)
    {
        $q = null;
        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $elem_arr = $this->getElemArr($type_affectation_tag, $elem_id);
        $articles_disponibles = Article::disponibles()->get()->pluck('reference_complete', 'id')->toArray();
        $nowdate = Carbon::now();

        $articles_a_affecter = null;
        $articles_a_affecter_json = null;
        $articles_disponibles_json = json_encode($articles_disponibles);

        return view('affectations.elemcreate')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('type_affectation', $type_affectation)
          ->with('elem_arr', $elem_arr)
          ->with('articles_a_affecter', $articles_a_affecter)
          ->with('q', $q)
          ->with('nowdate', $nowdate)
          ->with('articles_a_affecter_json', $articles_a_affecter_json)
          ->with('articles_disponibles_json', $articles_disponibles_json)
          ;
    }

    public function elemstore_save20200701(Request $request, $type_affectation_tag, $elem_id)
    {
        // Validate the form
        $formInput = $request->all();
        $nowdate = Carbon::now();
        $q = $request->has('q') ? $formInput['q'] : '';

        $affectation = new Affectation();
        $affectation->objet = $request->has('objet') ? $formInput['objet'] : '';

        if ($request->has('articles_a_affecter'))
          $articles_a_affecter = $formInput['articles_a_affecter'];
        else
          $articles_a_affecter = null;

        if ($request['action'] == 'valider-affectation') {
            //dd('Validate the form for create', $request);
            // $request->validate([
            //   'objet' => 'required',
            //   'articles_a_affecter' => 'required',
            //   'date_debut' => 'required|date',
            // ]);
            $request->validate(Affectation::createRules());
        } else {
            if ($request['action'] == 'search-articles') {
                $results_arr = $this->listArticlesSearch($request, $type_affectation_tag, $elem_id, $q);
            } elseif ($request['action'] == 'add-articles') {
            	  $results_arr = $this->listArticlesAdd($request, $type_affectation_tag, $elem_id, $q);
            } elseif ($request['action'] == 'remove-articles') {
                  $results_arr = $this->listArticlesRemove($request, $type_affectation_tag, $elem_id, $q);
            } else {

            }

            return view('affectations.elemcreate')
                ->with('articles_disponibles', $results_arr['articles_disponibles'])
                ->with('articles_a_affecter', $results_arr['articles_a_affecter'])
                ->with('articles_disponibles_json', $results_arr['articles_disponibles_json'])
                ->with('articles_a_affecter_json', $results_arr['articles_a_affecter_json'])
                ->with('type_affectation', $results_arr['type_affectation'])
                ->with('elem_arr', $results_arr['elem_arr'])
                ->with('q', $q)
                ->with('affectation', $affectation)
                ->with('nowdate', $nowdate)
              ;
        }

        $type_affectation = TypeAffectation::tagged($type_affectation_tag)->first();
        $formInput = $request->all();
        $articles_a_affecter = json_decode($formInput['articles_a_affecter'], true);

        $this->createNew($formInput['objet'], $formInput['date_debut'], $type_affectation_tag, $elem_id ,$articles_a_affecter);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.affectationCreated', ['affectationtype' => $type_affectation->libelle] ));

        $show_controller = $type_affectation_tag . 'Controller@' . 'show';

        return redirect()->action($show_controller, $elem_id);
    }

    private function convert_customer_data_to_html($affectation_id) {
      $data = Affectation::where('tags', 'NOT LIKE', "%Systeme%")->OrWhereNull('tags')->get();

      $affectation = Affectation::find($affectation_id);

      $gt_logo_url = public_path()  . "/assets/images/logo_gt.jpg";//url("assets/images/gt.png");
      $inter_ligne = '-------------------------------------';

      $nomprenom = $affectation->beneficiaire->denomination;
      $phone = $affectation->beneficiaire->phonenums()->first()->numero;

      $departement_infos=$this->getDepartementInfos($affectation->beneficiaire->departement);

      $fonction = $affectation->beneficiaire->fonction->intitule;
      $service = $departement_infos[0];
      $division = $departement_infos[1];
      $direction = $departement_infos[2];





      $output = '
        <img height="60" src="'. $gt_logo_url .'" class="ribbon"/>
        <p align="center">GABON TELECOM<br/>
        '.$inter_ligne.'<br/>
        DIRECTION RESEAUX<br/>
        '.$inter_ligne.'<br/>
        DIVISION DES SYSTEMES D INFORMATION<br/>
        '.$inter_ligne.'<br/>
        SI PRODUCTION<br/>
        </p>
        <hr>


        ';
      foreach($affectation->affectationarticles as $affectationarticle) {
          if ($affectationarticle->date_fin) {

          } else {




        $output.= '


        <p align="center">N°:</p>
        <h2 align="center">FICHE D‘AFFECTATION MATERIEL INFORMATIQUE</h2>
        <p><strong> Nom & Prenom :</strong> '.$nomprenom.'</br>
         <p><strong> Direction: </strong>'.$direction.' </br>
          <p><strong> Division:</strong> '.$division.' </br>
           <p><strong> Service:</strong> '.$service.' </br>

        <p><strong> Fonction:&nbsp;</strong>'.$fonction.' </br>
        <p><strong> Numero de télephone : </strong>'.$phone.'</br>
        <hr>
        <p><strong> Type de l‘article :</strong>'.$affectationarticle->article->typearticle->denomination.' </br>
        <p><strong> Marque :</strong>'.$affectationarticle->article->marquearticle->denomination.' </br>
        <p><strong> Model : </strong> </br>
        <p><strong> N°Série : </strong> </br>

        <hr>
        <hr>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <p><strong> Date d‘affectation  :</strong></br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;




        <p><strong> Tecnicien support : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

         Signature Utilisateur :  </strong> </p>





        <p><strong> Nom :....................................... </strong></p>
        <p><strong> Signature :...............................</strong></p>






          ';
          }
      }
      $output.='</table>';
      return $output;
    }

    function pdf($affectation) {
      //dd($affectation);
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($this->convert_customer_data_to_html($affectation));
      return $pdf->stream();
    }

    private function getDepartementInfos($departement) {

      // le tableau de retour ( 0=service ou agence; 1=division ou zone; 2=direction)
      $departement_infos=[" ", " ", " "];

      $nb_dpt=0;
      $temp_dpt = $departement;
      while( $nb_dpt < 3)
      {
        if (!is_null($temp_dpt)) {
          if ($temp_dpt->typedepartement->intitule == "Service" || $departement->typedepartement->intitule == "Agence")
          {
            $departement_infos[0] = $temp_dpt->intitule;
          } elseif ($temp_dpt->typedepartement->intitule == "Division" || $departement->typedepartement->intitule == "Zone")
          {
            $departement_infos[1] = $temp_dpt->intitule;
          } else
          {
            $departement_infos[2] = $temp_dpt->intitule;
          }

          $temp_dpt = $temp_dpt->parent;
        }

        $nb_dpt = $nb_dpt + 1;

      }
      return $departement_infos;
  }

  public function ficheretour($affectation_id) {

      $affectation = Affectation::find($affectation_id);

      $elem_arr = $this->getElemArr($affectation->typeAffectation->tags, $affectation->beneficiaire->id);

      return view('affectations.ficheretour')
          ->with('affectation', $affectation)
          ->with('elem_arr', $elem_arr);
  }

  public function addFicheretour(Request $request, $affectation_id) {
      // Validate the form
      $request->validate(Affectation::ficheRetourRules());
      $fieldname = "fiche_retour";
      $affectation = Affectation::find($affectation_id);
      //dd($request, $affectation, $request->files->get($fieldname));
      if( $request->hasFile( $fieldname ) ) {

          if (!$request->file($fieldname)->isValid()) {

              flash('Invalid File!')->error()->important();

              return redirect()->back()->withInput();
          }

          $file_dir = config('app.affectationficheretour_filefolder');

          // Check if the old file exists inside folder
          if ($affectation->fiche_retour) {
              if (file_exists($file_dir . '/' . $affectation->fiche_retour)) {
                  unlink($file_dir . '/' . $affectation->fiche_retour);
              }
          }

          // Set image name
          $file = $request->files->get($fieldname);
          $file_name = md5($file_dir . '_' . time()) . '.' . $file->getClientOriginalExtension();

          //dd($request, $file, $file_name, $file->getSize());

          // Move image to folder
          $file->move($file_dir, $file_name);
          $affectation->fiche_retour = $file_name;
          $affectation->fiche_retour_taille = $file->getSize();
          $affectation->save();

          // Sessions Message
          $request->session()->flash('msg_success',__('messages.affectationFicheRetourCreated' ));

          return redirect()->action('AffectationController@ficheretour', $affectation->id);

      } else {

          flash('Request has not File!')->error()->important();
          return redirect()->back()->withInput();
      }

  }





}
