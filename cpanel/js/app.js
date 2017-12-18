var app= angular.module('spaApp', ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
	.when('/', {
		templateUrl:'views/promotions.php',
		controller:'PromotionsCtrl',
	})
	.when('/news',{
	templateUrl:'views/news.php',
	controller:'NewsCtrl',
	})
	.when('/news/:idNew',{
	templateUrl:'views/news.php',
	controller:'NewsEditCtrl',

	})
	.when('/associations',{
		templateUrl:'views/associations.php',
		controller:'AssociationsCtrl',
	})
	.when('/shops',{
		templateUrl:'views/shops.php',
		controller:'ShopsCtrl',
	})
	.when('/shops/:idShop/:indexList',{
		templateUrl:'views/shops.php',
		controller:'ShopsEditCtrl',
	})
	.when('/slider/:check/:l',{
		templateUrl:'views/slider.php',
		controller:'SliderCtrl',
	})

	.when('/slider/:idSlider',{
		templateUrl:'views/slider.php',
		controller:'SliderDescCtrl',
	})
	.when('/settings',{
		templateUrl:'views/settings.php',
		controller:'SettingsCtrl',
	})
	.when('/promotions',{
		templateUrl:'views/promotions.php',
		controller:'PromotionsCtrl',
	})

	.when('/promotion/:idPromotion',{
	templateUrl:'views/promotions.php',
	controller:'PromotionCtrl',

	})
	.when('/subcategories',{
		templateUrl:'views/subcategories.php',
		controller:'SubcategoriesCtrl',
	})
	.when('/subcategories/:action/:idSubCategory/:name',{
		templateUrl:'views/subcategories.php',
		controller:'SubcategoriyCtrl',
	})
	.when('/formFichero',{
		templateUrl:'views/formFichero.html',
		controller:'SubirCtrl',
	})
	.when('/links',{
		templateUrl:'views/links.php',
		controller:'LinksCtrl',
	})
	.when('/links/:acc/:idLink',{
		templateUrl:'views/links.php',
		controller:'LinkCtrl',
	})

	.when('/mailing',{
		templateUrl:'views/mailing.php',
		controller:'MailsCtrl',
	})
	
	

    .otherwise({
        redirectTo: '/'
    });
}]); 
 
//ENVIAR USUARIOS DEPENDIENDO DE QUIEN ESTA CONECTADO DEL 1-4