<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Auth::routes();

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'HomeController@index')->name('home');
    });

    Route::get('send-mail', function () {

        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        \Mail::to('j.ngomnze@gabontelecom.ga')->send(new \App\Mail\AffectationNew());

        dd("Email is Sent.");


        /*$beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.affectations.new', [], function($message)
        {
            $message
                ->from('j.ngomnze@gabontelecom.ga')
                ->to('j.ngomnze@gabontelecom.ga', 'John Smith')
                ->subject('Welcome!');
        });*/

    });

    Route::get('/tests', function () {
        	return view('tests.index');
   	})->name('tests');

    Route::prefix('ldap')->group(function(){
        Route::get('/test', 'CustomLdapController@test')->name('ldaptest');
        Route::get('/sync', 'CustomLdapController@sync')->name('ldapsync');
    });


    /**
     * Users & Roles
     */
    // Roles
    Route::resource('roles','RoleController')->middleware('auth');
    // Users
    Route::resource('users','UserController')->middleware('auth');
    // Permissions
    Route::get('/selectmorepermissions', 'PermissionController@selectmorepermissions')->middleware('auth');
    Route::get('/selectmoreroles', 'RoleController@selectmoreroles')->middleware('auth');

    /**
     * Tags
     */
    Route::get('/select2-remote-data-source', 'TagController@select2RemoteDataSource')->middleware('auth');
    Route::get('/select2-load-more', 'TagController@select2LoadMore')->middleware('auth');
    Route::get('/selectmoretags', 'TagController@selectmoretags')->middleware('auth');

    /**
     * Articles & Types
     */
    Route::get('articlesettypes', 'ArticlesEtTypesController@index')->name('articlesettypes.index')->middleware('auth');
    // Type Articles
    Route::resource('typearticles', 'TypeArticleController')->middleware('auth');
    Route::get('typearticles.softget', 'TypeArticleController@softget')->name('typearticles.softget')->middleware('auth');
    // Marques
    Route::resource('marquearticles', 'MarqueArticleController')->middleware('auth');
    Route::get('marquearticles.softget', 'MarqueArticleController@softget')->name('marquearticles.softget')->middleware('auth');
    Route::post('marquearticles.softadd', 'MarqueArticleController@softadd')->name('marquearticles.softadd')->middleware('auth');
    // Articles
    Route::resource('articles', 'ArticleController')->middleware('auth');
    Route::get('articles/{type_affectation_tag}/{elem_id}/affectation', 'ArticleController@affectation')->name('articles.affectation')->middleware('auth');
    Route::put('articles/{type_affectation_tag}/{elem_id}/affectationupdate', 'ArticleController@affectationupdate')->name('articles.affectationupdate')->middleware('auth');

    /**
     * Phonenums
     */
    Route::resource('phonenums', 'PhonenumController')->middleware('auth');
    Route::get('phonenums/{elem_type}/{elem_id}/', 'PhonenumController@editelem')->name('phonenums.editelem')->middleware('auth');
    Route::put('phonenums/{elem_type}/{elem_id}/{phonenum_id}/', 'PhonenumController@updateelem')->name('phonenums.updateelem')->middleware('auth');
    Route::post('phonenums/{elem_type}/{elem_id}/', 'PhonenumController@storeelem')->name('phonenums.storeelem')->middleware('auth');

    /**
     * Adresseemails
     */
    Route::resource('adresseemails', 'AdresseemailController')->middleware('auth');
    Route::get('adresseemails/{elem_type}/{elem_id}/', 'AdresseemailController@editelem')->name('adresseemails.editelem')->middleware('auth');
    Route::put('adresseemails/{elem_type}/{elem_id}/{adresseemail_id}/', 'AdresseemailController@updateelem')->name('adresseemails.updateelem')->middleware('auth');
    Route::post('adresseemails/{elem_type}/{elem_id}/', 'AdresseemailController@storeelem')->name('adresseemails.storeelem')->middleware('auth');

    /**
     * Employes & Départements
     */
    // Fonction employe
    Route::resource('fonctionemployes', 'FonctionEmployeController')->middleware('auth');
    Route::post('fonctionemployes.softadd', 'FonctionEmployeController@softadd')->name('fonctionemployes.softadd')->middleware('auth');
    Route::get('fonctionemployes.softget', 'FonctionEmployeController@softget')->name('fonctionemployes.softget')->middleware('auth');
    // Employes
    Route::resource('employes', 'EmployeController')->middleware('auth');
    Route::get('employes.softget', 'EmployeController@softget')->name('employes.softget')->middleware('auth');
    // Type Departement
    Route::resource('typedepartements', 'TypeDepartementController')->middleware('auth');
    // Departement
    Route::resource('departements', 'DepartementController')->middleware('auth');
    Route::get('departements.softget', 'DepartementController@softget')->name('departements.softget')->middleware('auth');

    /**
     * Fournisseurs
     */
    Route::resource('fournisseurs', 'FournisseurController')->middleware('auth');
    Route::get('fournisseurs.softget', 'FournisseurController@softget')->name('fournisseurs.softget')->middleware('auth');

    /**
     * Commandes
     */
    Route::resource('commandes', 'CommandeController')->middleware('auth');

    /**
     * Affectations
     */
    Route::resource('affectations', 'AffectationController')->middleware('auth');

    Route::get('affectations/{affectation}/pdf', 'AffectationController@pdf')->name('affectations.pdf')->middleware('auth');
    Route::get('affectations/{type_affectation_tag}/{elem_id}/', 'AffectationController@elemcreate')->name('affectations.elemcreate')->middleware('auth');
    Route::post('affectations/{type_affectation_tag}/{elem_id}/', 'AffectationController@elemstore')->name('affectations.elemstore')->middleware('auth');

    Route::get('affectations/{affectation}/printpreview', 'AffectationController@printpreview')->name('affectations.printpreview')->middleware('auth');

    /**
     * Parametres
     */
    Route::get('parametres', 'ParametreController@index')->name('parametres.index')->middleware('auth');
    // Statut
    Route::resource('statuts', 'StatutController')->middleware('auth');
    Route::get('statuts.change', 'StatutController@change')->name('statuts.change')->middleware('auth');
    // TypeMouvement
    Route::resource('typemouvements', 'TypeMouvementController')->middleware('auth');
    // EtatCommande
    Route::resource('etatcommandes', 'EtatCommandeController')->middleware('auth');
    // TypeAffectation
    Route::resource('typeaffectations', 'TypeAffectationController')->middleware('auth');
    // EtatArticle
    Route::resource('etatarticles', 'EtatArticleController')->middleware('auth');

    /**
     * Stocks
     */
    Route::resource('stocks', 'StockController')->middleware('auth');

    /**
     * Corbeille
     */
    Route::resource('recyclebin', 'RecycleBinController')->middleware('auth');
    Route::post('recyclebin/{recyclebin}', 'RecycleBinController@restore')->name('recyclebin.restore')->middleware('auth');
    Route::post('recyclebin', 'RecycleBinController@restoreOrDelete')->name('recyclebin.restoreOrDelete')->middleware('auth');
    //Route::match(['put'],'recyclebin/{id}', 'RecycleBinController@restore')->name('recyclebin.restore')->middleware('auth');
