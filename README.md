# Easeapp PHP Framework

Easeapp is a Simple MVC based Procedural Framework that is written in PHP.

Easeapp is based on Single Controller Pattern / Front Controller Pattern, that has a simple yet powerful routing system, that can be used to have all website URLs in SEO approach. It offers both Static as well as Dynamic routes, that enables the developer to use it for:

1. Web Application with Frontend and / or Backend
2. REST APIs
3. Ajax Calls etc...

<u>Note:</u> A different route, have to be uniquely defined for web page url / Ajax Call / REST API Endpoint. In scenarios, multiple routes can point to same file. All routes can be explicitly restricted to support a single method (GET / POST / PUT / DELETE etc) or leave it, as is, to work, on any Request Method.
 
This framework is a simple tool, that facilitates the Developer with a very simple base, in terms of MVC, while allowing them to code in either procedural / object oriented approaches.

### About Database:
This can use any Database, while MySQL / MariaDB is chosen as default database.

### About Security Guidelines:
This utilizes the minimal inbuilt security options, while providing several defaults, as convention, to secure the application, in reasonable way.

### About Virtual Cron Management:
This provides an abstraction to manage preset Cron Jobs, right from the application, through corresponding DB based Settings.

### About Encryption Support:
There is application level Encryption Support, with the support of Libsodium, that allows to use several Encryption / Digital Signature algorithms, in the Elliptical Cryptography (ECC) range, in the application.

This works with Libsodium v1.0.15 and above, on PHP v7.2.0 and later. The Cryptographic Library will gracefully not load, when PHP Version is either below v7.2.0 and / or if Libsodium has any potential setup issues.


### How to Create Routing Engine Rules, on Easeapp:

 **I. Some different combinations and related meanings (this is to differentiate whether the page is a frontend page or a admin panel page or related to Ajax / API Service):**
 
 1) **"is_ajax" => "0", "is_frontend_page" => "0"**
 This means, http request is normal (not ajax) and admin panel template has to be loaded

 2) **"is_ajax" => "0", "is_frontend_page" => "1"**
 This means, http request is normal (not ajax) and frontend template has to be loaded

 3) **"is_ajax" => "0", "is_frontend_page" => "2"**
 This means, http request is normal (not ajax) and based on logged in user type, either frontend template or admin panel template has to be loaded

 4) **"is_ajax" => "0", "is_frontend_page" => "3"**
 This means, http request is normal (not ajax) and this represents, inappropriate template settings

 5) **"is_ajax" => "1", "is_frontend_page" => "3"**
 This means, http request is an ajax request and this represents, pure ajax call/web service endpoint
 a) "is_web_service_endpoint" => "0"
 This means, http request is an ajax request and this represents, pure ajax call
 b) "is_web_service_endpoint" => "1"
 This means, http request is an ajax request and this represents, web service endpoint
 c) "is_web_service_endpoint" => "2"
 This means, http request is an ajax request and this represents, either ajax call or web service endpoint
 d) "is_web_service_endpoint" => "3"
 This means, http request is basically not an ajax request
  

 
 
 **II. This is to check the Request Method of the request:**
 
 1) **"request_method" => "ANY"**
 This means, there is no restriction about the METHOD that is used for this http / https request (GET / POST / PUT / DELETE all works), if the VALUE is ANY.
 
 2) **"request_method" => "GET"**
 This means, only requests that is initiated using GET METHOD are allowed, if the VALUE is GET.
 
 3) **"request_method" => "POST"**
 This means, only requests that is initiated using POST METHOD are allowed, if the VALUE is POST.
 
 4) **"request_method" => "PUT"**
 This means, only requests that is initiated using PUT METHOD are allowed, if the VALUE is PUT.
 
 5) **"request_method" => "DELETE"**
 This means, only requests that is initiated using DELETE METHOD are allowed, if the VALUE is DELETE.
 
 6) **"request_method" => "HEAD" (NOT COMPLETED)**
 This means, only requests that is initiated using HEAD METHOD are allowed, if the VALUE is HEAD. The Script will be terminated after outputting headers if output buffering is not enabled.
 

 <u>Example Routes:</u>
 
 1) The following is the Default Route for Web Application
 
    ```php
	$routes["default-home"] = array("route_value" => "/",
							  "route_var_count" => "2",
							  "page_filename" => "default-home.php",
                              "is_ajax" => "0",
						      "is_web_service_endpoint" => "3",
                              "is_frontend_page" => "1",
                              "request_method" => "ANY"                                    
                             );
	```

2) The following is the Route for Ajax Call
 
    ```php
	$routes["admin-panel-user-add-choose-type"] = array("route_value" => "/admin-panel/user/add/choose-type",
								 "route_var_count" => "5",
								 "page_filename" => is_session_valid($_SESSION['loggedin'], "admin-panel-user-add-choose-type.php"),
								 "is_ajax" => "1",
						         "is_web_service_endpoint" => "0",
								 "is_frontend_page" => "3",
								 "request_method" => "ANY"                                    
								); 
	```	
					   
3) The following is the Route for REST Web Service
 
    ```php
	$routes["rest-login"] = array("route_value" => "/rest/login",
							 "route_var_count" => "3",
							 "page_filename" => "rest-login.php",
							 "is_ajax" => "1",
                             "is_web_service_endpoint" => "1",
							 "is_frontend_page" => "3",
                             "request_method" => "POST"                                    
							);	
	```	
	
# License
The Easeapp PHP framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT "MIT License").
	