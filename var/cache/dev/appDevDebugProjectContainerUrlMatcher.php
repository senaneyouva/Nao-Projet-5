<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/images')) {
            // _assetic_2012410
            if ('/images/2012410.jpg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 2012410,  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_2012410',);
            }

            // _assetic_2012410_0
            if ('/images/2012410_retouche-blog_1.jpg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 2012410,  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_2012410_0',);
            }

            if (0 === strpos($pathinfo, '/images/7')) {
                // _assetic_70070ae
                if ('/images/70070ae.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '70070ae',  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_70070ae',);
                }

                // _assetic_70070ae_0
                if ('/images/70070ae_slide1_1.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '70070ae',  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_70070ae_0',);
                }

                // _assetic_7c3f43c
                if ('/images/7c3f43c.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '7c3f43c',  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_7c3f43c',);
                }

                // _assetic_7c3f43c_0
                if ('/images/7c3f43c_slide4_1.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '7c3f43c',  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_7c3f43c_0',);
                }

            }

            elseif (0 === strpos($pathinfo, '/images/b')) {
                // _assetic_bb90d0f
                if ('/images/bb90d0f.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bb90d0f',  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_bb90d0f',);
                }

                // _assetic_bb90d0f_0
                if ('/images/bb90d0f_gradient_1.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bb90d0f',  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_bb90d0f_0',);
                }

                // _assetic_b56162d
                if ('/images/b56162d.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b56162d',  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_b56162d',);
                }

                // _assetic_b56162d_0
                if ('/images/b56162d_binocular_1.jpg' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b56162d',  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_b56162d_0',);
                }

            }

            // _assetic_fb5cd6d
            if ('/images/fb5cd6d.png' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'fb5cd6d',  'pos' => NULL,  '_format' => 'png',  '_route' => '_assetic_fb5cd6d',);
            }

            // _assetic_fb5cd6d_0
            if ('/images/fb5cd6d_iphone_1.png' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'fb5cd6d',  'pos' => 0,  '_format' => 'png',  '_route' => '_assetic_fb5cd6d_0',);
            }

            // _assetic_0f2e946
            if ('/images/0f2e946.jpeg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '0f2e946',  'pos' => NULL,  '_format' => 'jpeg',  '_route' => '_assetic_0f2e946',);
            }

            // _assetic_0f2e946_0
            if ('/images/0f2e946_default-img_1.jpeg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '0f2e946',  'pos' => 0,  '_format' => 'jpeg',  '_route' => '_assetic_0f2e946_0',);
            }

            // _assetic_d8895cc
            if ('/images/d8895cc.jpg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd8895cc',  'pos' => NULL,  '_format' => 'jpg',  '_route' => '_assetic_d8895cc',);
            }

            // _assetic_d8895cc_0
            if ('/images/d8895cc_adhesion_1.jpg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd8895cc',  'pos' => 0,  '_format' => 'jpg',  '_route' => '_assetic_d8895cc_0',);
            }

            // _assetic_af7944a
            if ('/images/af7944a.jpeg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'af7944a',  'pos' => NULL,  '_format' => 'jpeg',  '_route' => '_assetic_af7944a',);
            }

            // _assetic_af7944a_0
            if ('/images/af7944a_contact-us_1.jpeg' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'af7944a',  'pos' => 0,  '_format' => 'jpeg',  '_route' => '_assetic_af7944a_0',);
            }

        }

        elseif (0 === strpos($pathinfo, '/js')) {
            // _assetic_889c46c
            if ('/js/889c46c.js' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '889c46c',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_889c46c',);
            }

            // _assetic_889c46c_0
            if ('/js/889c46c_owl.carousel.min_1.js' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '889c46c',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_889c46c_0',);
            }

            // _assetic_d9f6c51
            if ('/js/d9f6c51.js' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd9f6c51',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_d9f6c51',);
            }

            // _assetic_d9f6c51_0
            if ('/js/d9f6c51_app_1.js' === $pathinfo) {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd9f6c51',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_d9f6c51_0',);
            }

            // fos_js_routing_js
            if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_fos_js_routing_js;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
            }
            not_fos_js_routing_js:

        }

        elseif (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/css/2b2b8c0')) {
                // _assetic_2b2b8c0
                if ('/css/2b2b8c0.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '2b2b8c0',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_2b2b8c0',);
                }

                // _assetic_2b2b8c0_0
                if ('/css/2b2b8c0_style_1.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '2b2b8c0',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_2b2b8c0_0',);
                }

                // _assetic_2b2b8c0_1
                if ('/css/2b2b8c0_owl.carousel.min_2.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '2b2b8c0',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_2b2b8c0_1',);
                }

            }

            elseif (0 === strpos($pathinfo, '/css/4b0588c')) {
                // _assetic_4b0588c
                if ('/css/4b0588c.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4b0588c',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_4b0588c',);
                }

                // _assetic_4b0588c_0
                if ('/css/4b0588c_admin_1.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4b0588c',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_4b0588c_0',);
                }

                // _assetic_4b0588c_1
                if ('/css/4b0588c_owl.carousel.min_2.css' === $pathinfo) {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4b0588c',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_4b0588c_1',);
                }

            }

            // confirmation
            if (0 === strpos($pathinfo, '/confirmation') && preg_match('#^/confirmation/(?P<confirmationToken>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'confirmation')), array (  '_controller' => 'BT\\UserBundle\\Controller\\SecurityController::confirmAction',));
            }

            // contact
            if ('/contact' === $pathinfo) {
                return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::contactAction',  '_route' => 'contact',);
            }

        }

        elseif (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        elseif (0 === strpos($pathinfo, '/dashboard')) {
            // dashboard
            if ('/dashboard' === $trimmedPathinfo) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'dashboard');
                }

                return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::homeAction',  '_route' => 'dashboard',);
            }

            // dashboard-to-validate
            if ('/dashboard/to-validate-observation' === $pathinfo) {
                return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::toValidateAction',  '_route' => 'dashboard-to-validate',);
            }

            // dashboard-validate-observation
            if (0 === strpos($pathinfo, '/dashboard/observation/validate') && preg_match('#^/dashboard/observation/validate/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-validate-observation')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::validateAction',));
            }

            // dashboard-refuse-observation
            if (0 === strpos($pathinfo, '/dashboard/observation/refuse') && preg_match('#^/dashboard/observation/refuse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-refuse-observation')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::refuseAction',));
            }

            // dashboard-account
            if ('/dashboard/account' === $pathinfo) {
                return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::accountAction',  '_route' => 'dashboard-account',);
            }

            // dashboard-password
            if ('/dashboard/edit-password' === $pathinfo) {
                return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::editPasswordAction',  '_route' => 'dashboard-password',);
            }

            if (0 === strpos($pathinfo, '/dashboard/blog')) {
                // dashboard-blog
                if ('/dashboard/blog' === $pathinfo) {
                    return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::blogAction',  '_route' => 'dashboard-blog',);
                }

                // dashboard-blog-add
                if ('/dashboard/blog/add' === $pathinfo) {
                    return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::addPostAction',  '_route' => 'dashboard-blog-add',);
                }

                // dashboard-blog-edit
                if (0 === strpos($pathinfo, '/dashboard/blog/edit') && preg_match('#^/dashboard/blog/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-blog-edit')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::editPostAction',));
                }

                // dashboard-blog-remove
                if (0 === strpos($pathinfo, '/dashboard/blog/remove') && preg_match('#^/dashboard/blog/remove/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-blog-remove')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::removePostAction',));
                }

            }

            elseif (0 === strpos($pathinfo, '/dashboard/user')) {
                if (0 === strpos($pathinfo, '/dashboard/users')) {
                    // dashboard-users
                    if ('/dashboard/users' === $pathinfo) {
                        return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::naturalisteToValidateAction',  '_route' => 'dashboard-users',);
                    }

                    // dashboard-users-validate
                    if (0 === strpos($pathinfo, '/dashboard/users/validate') && preg_match('#^/dashboard/users/validate/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-users-validate')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::naturalisteValidateAction',));
                    }

                    // dashboard-users-refuse
                    if (0 === strpos($pathinfo, '/dashboard/users/refuse') && preg_match('#^/dashboard/users/refuse/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-users-refuse')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::naturalisteRefuseAction',));
                    }

                }

                // dashboard-user-delete
                if (0 === strpos($pathinfo, '/dashboard/user/delete') && preg_match('#^/dashboard/user/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'dashboard-user-delete')), array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::deleteUserAction',));
                }

                // dashboard-user
                if ('/dashboard/user' === $pathinfo) {
                    return array (  '_controller' => 'BT\\AdminBundle\\Controller\\AdminController::allUserAction',  '_route' => 'dashboard-user',);
                }

            }

        }

        // login
        if ('/login' === $pathinfo) {
            return array (  '_controller' => 'BT\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'login',);
        }

        // logout
        if ('/logout' === $pathinfo) {
            return array('_route' => 'logout');
        }

        // user_registration
        if ('/register' === $pathinfo) {
            return array (  '_controller' => 'BT\\UserBundle\\Controller\\SecurityController::registerAction',  '_route' => 'user_registration',);
        }

        // askforgot
        if ('/askforgot' === $pathinfo) {
            return array (  '_controller' => 'BT\\UserBundle\\Controller\\SecurityController::askForgotAction',  '_route' => 'askforgot',);
        }

        // adherer
        if ('/adherer' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::adhererAction',  '_route' => 'adherer',);
        }

        // edit-password
        if (0 === strpos($pathinfo, '/edit-password') && preg_match('#^/edit\\-password/(?P<forgotToken>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'edit-password')), array (  '_controller' => 'BT\\UserBundle\\Controller\\SecurityController::editPasswordAction',));
        }

        // home
        if ('' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'home');
            }

            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::indexAction',  '_route' => 'home',);
        }

        // blog
        if ('/post' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::blogAction',  '_route' => 'blog',);
        }

        // blog-single
        if (0 === strpos($pathinfo, '/blog/single') && preg_match('#^/blog/single/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'blog-single')), array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::singleBlogAction',));
        }

        // search-observation
        if ('/birds' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::searchObservationAction',  '_route' => 'search-observation',);
        }

        if (0 === strpos($pathinfo, '/observation')) {
            // observation
            if ('/observation' === $pathinfo) {
                return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::observationAction',  '_route' => 'observation',);
            }

            // observation-single
            if (0 === strpos($pathinfo, '/observation/single') && preg_match('#^/observation/single/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'observation-single')), array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::singleObservationAction',));
            }

        }

        // search-bird
        if ('/search' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::searchBirdAction',  '_route' => 'search-bird',);
        }

        // newsletter
        if ('/newsletter' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::newsletterAction',  '_route' => 'newsletter',);
        }

        // mentions
        if ('/mentions' === $pathinfo) {
            return array (  '_controller' => 'BT\\NaoBundle\\Controller\\NaoController::mentionAction',  '_route' => 'mentions',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
