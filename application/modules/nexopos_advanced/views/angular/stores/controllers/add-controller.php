var stores          =   function(
    storesAddTextDomain,
    $scope,
    $http,
    storesFields,
    storesResource,
    $location,
    sharedValidate,
    sharedRawToOptions,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Ajouter une Boutique', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   storesAddTextDomain;
    $scope.fields           =   storesFields;
    $scope.item             =   {};
    $scope.validate         =   new sharedValidate();

    //Submitting Form

    $scope.submit       =   function(){
    $scope.item.author           = <?= User::id()?>;
    $scope.item.date_creation    = sharedMoment.now();
    $scope.item.authorized_users = JSON.stringify($scope.item.authorized_users); // Converting array to string for database saving purpose

    if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
        return $scope.validate.blurAll( $scope.fields, $scope.item );
    }

    $scope.submitDisabled       =   true;

    storesResource.save(
        $scope.item,
        function(){
            $location.url( '/stores?notice=done' );
        },function( returned ){

            $scope.submitDisabled   =   false;

            if( returned.data.status === 'alreadyExists' ) {
                sharedAlert.warning( '<?php echo _s( 'Le nom de cette Boutique est déjà en cours d\'utilisation, veuillez choisir un autre nom.', 'nexopos_advanced' );?>' );
            }

            if( returned.data.status === 'forbidden' || returned.status == 500 ) {
                sharedAlert.warning( '<?php echo _s( 'Une erreur s\'est produite durant l\'opération.', 'nexopos_advanced' );?>' );
            }
        }
    )
    }
}

stores.$inject    =   [
    'storesAddTextDomain',
    '$scope',
    '$http',
    'storesFields',
    'storesResource',
    '$location',
    'sharedValidate',
    'sharedRawToOptions',
    'sharedDocumentTitle',
    'sharedMoment'
];

tendooApp.controller( 'stores', stores );
