var couponsEdit      =   function(
    couponsEditTextDomain,
    $scope,
    $http,
    $route,
    couponsFields,
    couponsResource,
    $location,
    sharedValidate,
    sharedDocumentTitle,
    sharedMoment
) {

    sharedDocumentTitle.set( '<?php echo _s( 'Editer un coupon', 'nexopos_advanced' );?>' );
    $scope.textDomain       =   couponsEditTextDomain;
    $scope.fields           =   couponsFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   new sharedValidate();

    // Get Resource when loading
    $scope.submitDisabled   =   true;
    couponsResource.get({
        id  :  $route.current.params.id // make sure route is added as dependency
    },function( entry ){
        $scope.submitDisabled   =   false;
        $scope.item             =   entry;
    })

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author              =   <?= User::id()?>;
        $scope.item.date_modification   =   sharedMoment.now();

        if( ! $scope.validate.run( $scope.fields, $scope.item ).isValid ) {
            return $scope.validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        couponsResource.update({
                id  :   $route.current.params.id // make sure route is added as dependency
            },
            $scope.item,
            function(){
                $location.url( '/coupons?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

couponsEdit.$inject    =   [
    'couponsEditTextDomain',
    '$scope',
    '$http',
    '$route',
    'couponsFields',
    'couponsResource',
    '$location',
    'sharedValidate',
    'sharedDocumentTitle',
    'sharedMoment'
];
tendooApp.controller( 'couponsEdit', couponsEdit );
