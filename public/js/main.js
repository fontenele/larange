var clone = function (obj) {
    return JSON.parse(JSON.stringify(obj));
};
/**
 * Configure Lib paths
 */
require.config({
    baseUrl: 'js',
    urlArgs: "_t=" + (new Date()).getTime(),
    paths: {
        //jquery
        'jquery': '../vendor/jquery/dist/jquery.min',
        //plugins
        'loading': 'plugins/loading',
        //noty
        'noty': '../vendor/noty/js/noty/packaged/jquery.noty.packaged.min',
        'noty-layout-center': '../vendor/noty/js/noty/layouts/center',
        'noty-layout-top': '../vendor/noty/js/noty/layouts/top',
        'noty-layout-bottom': '../vendor/noty/js/noty/layouts/bottom',
        'noty-theme-relax': '../vendor/noty/js/noty/themes/relax',
        //bootstrap
        'bootstrap': '../vendor/bootstrap/dist/js/bootstrap.min',
        // angular
        'angular': '../vendor/angular/angular.min',
        'ocLazyLoad': '../vendor/ocLazyLoad/dist/ocLazyLoad.require',
        'ngComponentRouter': '../vendor/angular-route/angular-route.min',
        // satellizer
        'satellizer': '../vendor/satellizer/dist/satellizer.min',
        // moment
        'momentjs': '../vendor/moment/min/moment.min',
        'momentLocales': '../vendor/moment/min/moment-with-locales.min',
        'momentLocalesAll': '../vendor/moment/locale/pt-br',
        'moment': 'plugins/moment',
        'angular-moment': '../vendor/angular-moment/angular-moment',
        // require plugins
        'text': '../vendor/text/text',
        'json': '../vendor/requirejs-plugins/src/json',
        // defaults
        'lib': '../vendor',
        'data': '..'
    },
    shim: {
        // Dependences
        'angular': ['jquery'],
        'loading': ['jquery'],
        'ngComponentRouter': ['angular'],
        'ocLazyLoad': ['angular'],
        'bootstrap': ['angular'],
        'satellizer': ['angular'],
        'momentLocales': ['momentLocalesAll'],
        'noty': ['jquery'],
        'noty-theme-relax': ['noty']
    },
    packages: {
    }
});

// Init libs
require([
    'moment',
    'ocLazyLoad',
    'ngComponentRouter',
    'bootstrap',
    'satellizer',
    'loading',
    'momentLocales'
], function(moment) {
    // @TODO ver essas variaveis, nao pode ter elas
    var homeRoute = '/home';
    var loginRoute = '/login';
    var authRoute = '/oauth/access_token';
    // var authRoute = '/api/authenticate';
    
    angular.module('Routing', [])
        // routesProvider
        .provider('routes', function() {
            this.$get = function() {
                return {
                }
            };

            this.routes = [];
            this.actual = '';
            this.homeRoute = 'home';
            this.loginRoute = 'login';
            this.authRoute = '/oauth/access_token';

            this.setActual = function(_actual) {
                this.actual = _actual;
            };
            this.getActual = function() {
                return this.actual;
            };
            this.setRoutes = function(_routes) {
                this.routes = _routes;
            };
            this.getRoute = function(route) {
                if(route) {
                    if(this.routes[route]) {
                        return this.routes[route];
                    }
                }
                if(this.routes[this.getActual()]) {
                    return this.routes[this.getActual()];
                }
                var _actual = this.getActual().split('/');
                var _validMax = _actual.length; // max deep validate
                var that = this;
                
                for(i in this.routes) {
                    var _replaces = {};
                    var _valided = 0; // actual deep validation
                    var _route2return = clone(that.routes[i]);
                    var _route = i.split('/');
                    
                    if(_route.length != _validMax) {
                        continue;
                    }
                    
                    for(var j=0;j<_validMax;j++) {
                        if(_route[j] == _actual[j]) {
                            _valided++;
                        }
                        if(_route[j].substr(0,1) == ':') {
                            _replaces[_route[j]] = _actual[j];
                            for(k in _route2return) {
                                if(typeof _route2return[k] != 'string') {
                                    continue;
                                }
                                _route2return[k] = _route2return[k].replace(_route[j], _actual[j]);
                            }
                            
                            _valided++;
                        }
                    }
                    
                    if(_valided == _validMax) {
                        _route2return['vars'] = _replaces;
                        return _route2return;
                    }
                }
                
                return {};
            };
        });
    
    var mainApp = angular.module("mainApp", ['ngRoute', 'oc.lazyLoad', 'satellizer', 'Routing']);
    
    mainApp.service('router', function($http, $q, $location) {
        this.routesProvider = null;
        this.setRoutesProvider = function(routesProvider) {
            this.routesProvider = routesProvider;
        };
        this.getRoutesProvider = function() {
            return this.routesProvider;
        };
        this.getJson = function(data) {
            var defer = $q.defer();
            if(!this.getRoutesProvider().getRoute().json) {
                defer.reject('JSON route not found. (' + this.getRoutesProvider().getActual() + ')');
            }
            var url = this.getRoutesProvider().getRoute().json;
            if(data) {
                url+= '?';
                for (key in data) {
                    url += encodeURIComponent(key)+"="+encodeURIComponent(data[key])+"&";
                }
            }
            $http.get(url).success(function(data) {
                defer.resolve(data);
            }).error(function (message, status) {
                if(status == 401) {
                    $location.path(homeRoute);
                    var n = noty({
                        layout: 'center',
                        type: 'error',
                        text: message,
                        animation: {
                            open: 'animated flipInX',
                            close: 'animated flipOutX',
                            easing: 'swing',
                            speed: 500
                        }
                    });
                    setTimeout(function () {
                        n.close();
                    }, 3000);
                }
            });
            return defer.promise;
        };
    });
    
    angular.element(document).ready(function($http) {
        require([
            'noty-theme-relax'
        ], function () {
            $.noty.defaults.theme = 'relax';
        });
        
        // Get routes
        $http.get('routes').then(function (routes) {

            mainApp.config(function($routeProvider, $ocLazyLoadProvider, $interpolateProvider, $authProvider, $httpProvider, $provide, routesProvider) {
                // Define routes
                routesProvider.setRoutes(routes);

                /**
                 * HTTP Request Interceptor
                 * @param $q
                 * @param $location
                 * @returns {{request: request, response: response, requestError: requestError, responseError: responseError}}
                 */
                function httpInterceptor($q, $location) {
                    return {
                        request: function(config) {
                            loading.show();
                            if(config.method != 'GET' && localStorage.getItem('token')) {
                                if(!config.data) {
                                    config.data = {access_token: localStorage.getItem('token')};
                                } else {
                                    config.data.access_token = localStorage.getItem('token');
                                }
                            }
                            return config;
                        },
                        response: function(response) {
                            loading.hide();
                            return response;
                        },
                        requestError: function(rejection) {
                            loading.hide();
                            return $q.reject(rejection);
                        },
                        responseError: function(rejection) {
                            switch(rejection.data.error) {
                                case "token_not_provided":
                                case "token_expired":
                                case "token_absent":
                                case "token_invalid":
                                case "access_denied":
                                    localStorage.removeItem('user');
                                    localStorage.removeItem('token');
                                    $location.path(loginRoute);
                                    break;
                                case "invalid_credentials":
                                    alert("usuário/senha inválidos");
                                    localStorage.removeItem('user');
                                    localStorage.removeItem('token');
                                    $location.path(loginRoute);
                                    break;
                            }

                            loading.hide();
                            return $q.reject(rejection);
                        }
                    }
                }

                // Define HTTP Request Interceptor
                $provide.factory('httpInterceptor', httpInterceptor);
                $httpProvider.interceptors.push('httpInterceptor');

                $authProvider.loginUrl = authRoute;

                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');

                $ocLazyLoadProvider.config({
                    jsLoader: requirejs,
                    debug: false
                });

                $routeProvider
                    .when('/:action*', {
                        template: '',
                        controller: function($rootScope, $scope, $routeParams, $ocLazyLoad, $q, $http, $compile, $templateRequest, $location, router) {
                            var lazyDeferred = $q.defer();
                            
                            routesProvider.actual = $routeParams.action;
                            var route = routesProvider.getRoute();

                            // Get User from storage
                            var user = JSON.parse(localStorage.getItem('user'));

                            router.setRoutesProvider(routesProvider);

                            if(routesProvider.actual != 'login' && !$rootScope.authenticated && !user) {
                                $location.path(routesProvider.getRoute('login').url);
                                $rootScope.menuItemAtual = routesProvider.getActual();
                                return lazyDeferred.promise;
                            }

                            switch(true) {
                                case !route.controller && !route.template:
                                    throw new Error("Route controller and template not found. (" + routesProvider.getActual() + ")");
                                    break;
                                case !route.controller:
                                    $templateRequest(route.template).then(function(html) {
                                        var tpl = angular.element(html);
                                        $('#ng-view').html(tpl);
                                        $compile(tpl)($scope);
                                    });
                                    break;
                                case !route.template:
                                    $ocLazyLoad.load(route.controller).then(function (module) {
                                    });
                                    break;
                                default:
                                    $ocLazyLoad.load(route.controller).then(function (module) {
                                        $templateRequest(route.template).then(function(html) {
                                            var tpl = angular.element(html);
                                            $('#ng-view').html(tpl);
                                            $compile(tpl)($scope);
                                        });
                                    });
                            }

                            return lazyDeferred.promise;
                        }
                    })
                    .otherwise({
                        redirectTo: 'home'
                    });
            })
                .run(function($rootScope, $location, $auth) {

                    $rootScope.$on('$routeChangeStart', function(event, next, current) {
                        // console.log("event", event);
                        // console.log("next", next);
                        // console.log("current", current);
                        // event.preventDefault();
                    });

                    $rootScope.$on('$routeChangeSuccess', function(event, current, previous) {
                        if(current.params.action == routes.login.url) {
                            $auth.logout();
                            $rootScope.authenticated = false;
                            $rootScope.currentUser = null;
                            // Remove User from storage
                            localStorage.removeItem('user');
                            localStorage.removeItem('token');
                            // Container class without sidebar
                            $rootScope.container_class = 'col-sm-12 col-md-12 main';
                        } else {
                            // Container class with sidebar
                            $rootScope.container_class = 'col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main';
                        }

                        // Get URL
                        var url = $location.path().substring(1);
                        // Get User from storage
                        var user = JSON.parse(localStorage.getItem('user'));

                        // Load menu dynamic, use $http ou $.get
                        $rootScope.menu = [
                            {label: 'Home', url: 'home', selected: false},
                            {label: 'View1', url: 'view1', selected: false},
                            {label: 'Admin', url: 'admin', selected: false}
                        ];

                        if(user) {
                            $rootScope.authenticated = true;
                            $rootScope.currentUser = user;
                        }

                        // Define active menu
                        for(i in $rootScope.menu) {
                            // Remove all selected
                            $rootScope.menu[i].selected = false;
                            // Add active to selected item
                            if($rootScope.menu[i].url == url) {
                                $rootScope.menu[i].selected = true;
                            }
                        }
                    });
                });

            // @TODO move this to directive.js
            mainApp.directive("menu", function($location) {
                return {
                    restrict: "E",
                    replace: true,
                    scope: {
                        loc: '@location',
                        items: '='
                    },
                    link: function($rootScope, $scope, $element) {
                        $rootScope.menuLink = function() {
                            $location.path(this.item.url);
                        };
                    },
                    template:   '<ul class="nav navbar-nav <% loc %>">' +
                    '<li ng-repeat="item in items" ng-class="{\'active\': item.selected}" >' +
                    '<a href="javascript:void(0)" ng-click="menuLink(item.url)"><% item.label %></a>' +
                    '</li>' +
                    '</ul>'

                }
            });
            
            mainApp.directive("paginator", function ($compile) {
                var maxPaginationItems = 5;
                return {
                    scope: {
                        current: '@current',
                        maxpages: '@maxpages',
                        perpage: '@perpage',
                        callback: '&'
                    },
                    link: function($rootScope, $scope, $element) {
                        $rootScope.linkpaginate = function(page, current, maxpages, perpage) {
                            if(current == page) {
                                return;
                            }
                            $rootScope.callback()({page: page, current: current, maxpages: maxpages, perpage: perpage});
                        };
                        $rootScope.linkpaginateprevious = function(current, maxpages, perpage) {
                            if(current == 1) {
                                return;
                            }
                            $rootScope.callback()({page: (parseInt(current)-1), current: current, maxpages: maxpages, perpage: perpage});
                        };
                        $rootScope.linkpaginatenext = function(current, maxpages, perpage) {
                            if(current == maxpages) {
                                return;
                            }
                            $rootScope.callback()({page: (parseInt(current)+1), current: current, maxpages: maxpages, perpage: perpage});
                        };
                        $rootScope.showOrNot = function(current, maxpages) {
                            if(parseInt(maxpages) === 1) {
                                return false;
                            }
                            return true;
                        };
                        $rootScope.getPaginatorItems = function(current, maxpages) {
                            if(!current || !maxpages) {
                                return;
                            }
                            
                            current = parseInt(current);
                            maxpages = parseInt(maxpages);
                            var halfItems = Math.ceil(maxPaginationItems / 2);
                            var items = [];
                            var max = (current > halfItems) ? ( ((current-1) + halfItems) < maxpages ? ((current-1) + halfItems) : maxpages) : maxPaginationItems;
                            var min = (current > halfItems) ? (current+1) - halfItems : 1;
                            if((max+1) - min < maxPaginationItems) {
                                min-= maxPaginationItems - ((max+1) - min);
                                if(min == 0) {
                                    min = 1;
                                }
                            }
                            
                            if(max > maxpages) {
                                min = 1;
                                max = maxpages;
                            }
                            
                            if(min == max) {
                                return items;
                            }
                            
                            for(var i=min;i<=max;i++) {
                                items.push(i);
                            }
                            
                            if(min > 1) {
                                items.unshift('...');
                                items.unshift('1');
                            }
                            
                            if(maxpages > max) {
                                items.push('...');
                                items.push(maxpages);
                            }

                            return items;
                        }
                    },
                    template: function(element, attrs) {
                        return '<ul class="pagination" ng-show="showOrNot(current, maxpages)">' +
                            '<li  ng-click="linkpaginateprevious(current, maxpages, perpage)">' +
                                '<a href="javascript:void(0)" aria-label="Previous">' +
                                    '<span aria-hidden="true">&laquo;</span>' +
                                '</a>' +
                            '</li>' +
                            '<li ng-repeat="item in getPaginatorItems(current, maxpages) track by $index" ng-click="linkpaginate(item, current, maxpages, perpage)"  ng-class="item == current ? \'active\' : \'\' ">' +
                                '<a href="javascript:void(0)"><% item %></a>' +
                            '</li>' +
                            '<li ng-click="linkpaginatenext(current, maxpages, perpage)">' +
                                '<a href="javascript:void(0)" aria-label="Next">' +
                                    '<span aria-hidden="true">&raquo;</span>' +
                                '</a>' +
                            '</li>' +
                        '</ul>'
                    }
                }
            });
            
            /**
             * Date Format View Helper
             */
            mainApp.filter('dateFormat', function() {
                return function(input, toDate, fromDate) {
                    if(input == null){ return ""; }

                    if(fromDate) {
                        return moment(input, fromDate).format(toDate);
                    }
                    return moment(input).format(toDate);
                };
            });

            /**
             * App Main Controller
             */
            mainApp.controller('PrincipalController', function($scope, $ocLazyLoad, $routeParams, $location, $auth) {
                $scope.menuItemAtual = $location.path().substring(1);

                $scope.menuItem = function(url, logout) {
                    if(logout) {
                        // Logout in satellizer
                        $auth.logout();
                        // Remove User from storage
                        localStorage.removeItem('user');
                    }
                    $location.path(url);
                };
            });

            /**
             * Bootstrap angular
             */
            angular.bootstrap(document.body, ['mainApp']);
        });
        
        
    });
});
