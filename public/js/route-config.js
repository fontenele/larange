define([
    'registers/lazy-directives',
    'registers/lazy-services',
    'registers/lazy-filters'
], function(lazyDirectives, lazyServices, lazyFilters) {
    var $controllerProvider;
    
    function setControllerProvider(value) {
        $controllerProvider = value;
    }

    function setCompileProvider(value) {
        lazyDirectives.setCompileProvider(value);
    }

    function setProvide(value) {
        lazyServices.setProvide(value);
    }

    function setFilterProvider(value) {
        lazyFilters.setFilterProvider(value);
    }

    function config(templatePath, controllerPath, lazyResources) {
        if(!$controllerProvider) {
            throw new Error('$controllerProvider is not set!');
        }

        var defer,
            html,
            routeDefinition = {};

        routeDefinition.template = function() {
            return html;
        };

        routeDefinition.controller = controllerPath.substring(controllerPath.lastIndexOf('/') + 1);

        routeDefinition.resolve = {
            delay: function($q, $rootScope) {
                defer = $q.defer();

                if(!html) {
                    var dependences = ['text!' + templatePath, controllerPath];

                    if(lazyResources) {
                        dependences = dependences.concat(lazyResources.directives);
                        dependences = dependences.concat(lazyResources.services);
                        dependences = dependences.concat(lazyResources.filters);
                    }

                    require(dependences, function() {
                        var indicator = 0;

                        var template = arguments[indicator++];

                        if(angular.isDefined(controllerPath)) {
                            $controllerProvider.register(controllerPath.substring(controllerPath.lastIndexOf('/') + 1), arguments[indicator]);
                            indicator++;
                        }

                        if(angular.isDefined(lazyResources)) {
                            if(angular.isDefined(lazyResources.directives)) {
                                for(var i=0, l=lazyResources.directives.length;i<l; i++) {
                                    lazyDirectives.register(arguments[indicator]);
                                    indicator++;
                                }
                            }
                            if(angular.isDefined(lazyResources.services)) {
                                for(var i=0, l=lazyResources.services.length;i<l; i++) {
                                    lazyServices.register(arguments[indicator]);
                                    indicator++;
                                }
                            }
                            if(angular.isDefined(lazyResources.filters)) {
                                for(var i=0, l=lazyResources.filters.length;i<l; i++) {
                                    lazyFilters.register(arguments[indicator]);
                                    indicator++;
                                }
                            }

                        }

                        html = template;
                        defer.resolve();
                        $rootScope.$apply();
                    });
                } else {
                    defer.resolve();
                }

                return defer.promise;
            }
        };

        return routeDefinition;
    }

    return {
        setControllerProvider: setControllerProvider,
        setCompileProvider: setCompileProvider,
        setProvide: setProvide,
        setFilterProvider: setFilterProvider,
        config: config
    };
});