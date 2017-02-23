var customers          =   function( customersTextDomain, $scope, $http, customersFields, customersResource, $location, validate, sharedCustomersGroupsResource, rawToOptions ) {

    $scope.textDomain       =   customersTextDomain;
    $scope.fields           =   customersFields;
    $scope.item             =   {};
    $scope.item.auto_cost   =   'no';
    $scope.validate         =   validate;

    // Settings options for selecting parent group
    
    sharedCustomersGroupsResource.get(
        function(data){
            $scope.fields[7].options = rawToOptions(data.entries, 'id', 'name');
        }
    );

    /**
     *  Update Date
     *  @param object date
     *  @return void
    **/

    $scope.updateDate   =   function( date, key ){
        $scope.item[ key ]    =   date;
    }

    $scope.submit       =   function(){
        $scope.item.author          =   <?= User::id()?>;
        $scope.item.date_creation   =   '<?php echo date_now();?>';

        if( ! validate.run( $scope.fields, $scope.item ).isValid ) {
            return validate.blurAll( $scope.fields, $scope.item );
        }

        $scope.submitDisabled       =   true;

        customersResource.save(
            $scope.item,
            function(){
                $location.url( '/customers?notice=done' );
            },function(){
                $scope.submitDisabled       =   false;
            }
        )
    }
}

customers.$inject    =   [ 'customersTextDomain', '$scope', '$http', 'customersFields', 'customersResource', '$location', 'validate' , 'sharedCustomersGroupsResource', 'rawToOptions'];
tendooApp.controller( 'customers', customers );
