<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>Inventory Management</title>
    <!--
    SOFTY PINKO
    https://templatemo.com/tm-535-softy-pinko
    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-softy-pinko.css') }}">
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo" style="margin-top:5px">
                            <img src="{{ Storage::url($app_logo) }}" alt="Inventory Management" style="width: 150px; height: auto;" />
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="#welcome" class="active">Home</a></li>
                            <li><a href="#features">About</a></li>
                            <li><a href="#work-process">Work Process</a></li>
                            <li><a href="#testimonials">Testimonials</a></li>
                            <li><a href="#pricing-plans">Pricing Tables</a></li>
                            {{-- <li><a href="#blog">Blog Entries</a></li> --}}
                            <li><a href="#contact-us">Contact Us</a></li>
                            <li><a href="{{ asset('/login') }}">Sign In</a></li>
                            <li><a href="{{ asset('/customer_signup') }}">Sign Up</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">
        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                        <h1>We provide the best <strong>strategy</strong><br>to grow up your <strong>business</strong></h1>
                        <p>Our Inventory Management System is designed to help your business thrive. With robust features tailored to your needs, 
                            we ensure seamless operations and optimal efficiency. Our solution is provided to you with no additional costs, 
                            empowering your business to grow and succeed. </p>
                        <a href="#features" class="main-button-slider">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Small Start ***** -->
    <section class="section home-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="{{ asset('assets/images/featured-item-01.png') }}" alt=""></i>
                                </div>
                                <h5 class="features-title">Modern Strategy</h5>
                                <p>Customize any aspect of this Inventory Management System to meet the unique needs of your business.</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="{{ asset('assets/images/featured-item-01.png') }}" alt=""></i>
                                </div>
                                <h5 class="features-title">Best Relationship</h5>
                                <p>Contact us immediately if you have any questions or need assistance with your Inventory Management System. </p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="{{ asset('assets/images/featured-item-01.png') }}" alt=""></i>
                                </div>
                                <h5 class="features-title">Ultimate Marketing</h5>
                                <p>Spread the word about our Inventory Management System to your colleagues and business partners.</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->

    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{asset('assets/images/left-image.png')}}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title">Let’s discuss about you project</h2>
                    </div>
                    <div class="left-text">
                        <p>Let’s talk about your project and how we can collaborate to bring it to life. We focus on understanding your goals, challenges, and the best ways to address them. Our team is here to provide the support and expertise you need for success.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                    <div class="left-heading">
                        <h2 class="section-title">We can help you to grow your business</h2>
                    </div>
                    <div class="left-text">
                        <p>We offer the expertise to help you expand your business, providing the right tools and strategies to support your growth. From managing operations to streamlining workflows, we focus on enhancing your efficiency and performance. Let us assist you in overcoming challenges and achieving your goals.</p>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('assets/images/right-image.png')}}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Home Parallax Start ***** -->
    <section class="mini" id="work-process">
        <div class="mini-content">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-3 col-lg-6">
                        <div class="info">
                            <h1>Work Process</h1>
                            <p>We follow a structured process to ensure efficiency and quality in every project. Our team focuses on understanding your requirements, planning the necessary steps, and executing them with precision. Each phase is carefully monitored to deliver the best results.</p>
                        </div>
                    </div>
                </div>

                <!-- ***** Mini Box Start ***** -->
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Get Ideas</strong>
                            <span>Innovative, creative, bold, transformative, inspiring.</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Sketch Up</strong>
                            <span>Intuitive, powerful, versatile, user-friendly, efficient.</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Discuss</strong>
                            <span>Engage, explore, exchange, collaborate, communicate.</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Revise</strong>
                            <span>Edit, improve, refine, update, enhance.</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Approve</strong>
                            <span>Confirm, authorize, accept, validate, endorse.</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                        <a href="#" class="mini-box">
                            <i><img src="{{ asset('assets/images/work-process-item-01.png')}}" alt=""></i>
                            <strong>Launch</strong>
                            <span>Initiate, unveil, introduce, activate, promote.</span>
                        </a>
                    </div>
                </div>
                <!-- ***** Mini Box End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Home Parallax End ***** -->

    <!-- ***** Testimonials Start ***** -->
    <section class="section" id="testimonials">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">What do they say?</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Our clients rave about how our IMS has transformed their inventory processes. With seamless integration, real-time updates, and efficient tracking, businesses have experienced significant improvements in operational efficiency. The system’s user-friendly interface and powerful features make inventory management easier, allowing businesses to focus on growth and customer satisfaction. "The best decision we made for streamlining our operations!" – One of our satisfied clients.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <!-- ***** Testimonials Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <i><img src="{{ asset('assets/images/testimonial-icon.png')}}" alt=""></i>
                            <p>Responsible for ensuring everything runs smoothly across departments. From managing user permissions to overseeing inventory workflows, the system provides you with the tools to efficiently manage operations and maintain optimal performance across the business.</p>
                            <div class="user-image">
                                <img src="http://placehold.it/60x60" alt="">
                            </div>
                            <div class="team-info">
                                <h3 class="user-name">Sophie Grey</h3>
                                <span>System Administrator</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
                
                <!-- ***** Testimonials Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <i><img src="{{ asset('assets/images/testimonial-icon.png')}}" alt=""></i>
                            <p>Responsible for managing stock levels, updating inventory, generating reports, interacting with customers, and issuing accurate invoices for purchases. playing a key role in maintaining inventory accuracy and ensuring customer satisfaction.</p>
                            <div class="user-image">
                                <img src="http://placehold.it/60x60" alt="">
                            </div>
                            <div class="team-info">
                                <h3 class="user-name">Emily Davis</h3>
                                <span>Staff Member</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
                
                <!-- ***** Testimonials Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <i><img src="{{ asset('assets/images/testimonial-icon.png')}}" alt=""></i>
                            <p>responsible for developing, testing, and maintaining the IMS software. They collaborate with other team members to design system features, improve functionality, and ensure the system runs efficiently. The role includes writing clean, scalable code. </p>
                            <div class="user-image">
                                <img src="http://placehold.it/60x60" alt="">
                            </div>
                            <div class="team-info">
                                <h3 class="user-name">Mustafa Yusuf</h3>
                                <span>Software Engineer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Testimonials End ***** -->

    <!-- ***** Pricing Plans Start ***** -->
    <section class="section colored" id="pricing-plans">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Pricing Plans</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Our IMS offers flexible pricing plans to suit businesses of all sizes. Whether you're a small retailer or a large enterprise, we have options that cater to your needs. Enjoy a seamless experience with scalable features, designed to grow with your business. Choose the plan that best fits your operational requirements and start optimizing your inventory management today.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Starter</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">£</span>
                                <span class="price">127.50</span>
                                <span class="period">monthly</span>
                            </div>
                            <ul class="list">
                                <li class="active">60 GB space</li>
                                <li class="active">600 GB transfer</li>
                                <li class="active">Pro Design Panel</li>
                                <li>15-minute support</li>
                                <li>Unlimited Emails</li>
                                <li>24/7 Security</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="{{url('/customer_signup')}}" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                    <div class="pricing-item active">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Premium</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">£</span>
                                <span class="price">187.50</span>
                                <span class="period">monthly</span>
                            </div>
                            <ul class="list">
                                <li class="active">120 GB space</li>
                                <li class="active">1200 GB transfer</li>
                                <li class="active">Pro Design Panel</li>
                                <li class="active">15-minute support</li>
                                <li>Unlimited Emails</li>
                                <li>24/7 Security</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="{{url('/customer_signup')}}" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Advanced</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">£</span>
                                <span class="price">225.00</span>
                                <span class="period">monthly</span>
                            </div>
                            <ul class="list">
                                <li class="active">250 GB space</li>
                                <li class="active">5000 GB transfer</li>
                                <li class="active">Pro Design Panel</li>
                                <li class="active">15-minute support</li>
                                <li class="active">Unlimited Emails</li>
                                <li class="active">24/7 Security</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="{{url('/customer_signup')}}" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Pricing Plans End ***** -->

    <!-- ***** Counter Parallax Start ***** -->
    <section class="counter">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="count-item decoration-bottom">
                            <strong>126</strong>
                            <span>Projects</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="count-item decoration-top">
                            <strong>63</strong>
                            <span>Happy Clients</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="count-item decoration-bottom">
                            <strong>18</strong>
                            <span>Awards Wins</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="count-item">
                            <strong>27</strong>
                            <span>Countries</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Counter Parallax End ***** -->   

    <!-- ***** Blog Start ***** -->
    <section class="section" id="blog">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Blog Entries</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Stay up to date with the latest in Inventory Management!
                        Our blog covers insights and tips on optimizing inventory processes, managing stock levels, and using IMS tools to streamline operations. Discover valuable content to help your business run more efficiently.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-post-thumb">
                        <div class="img">
                            <img src="{{ asset('assets/images/blog-item-01.png')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <h3>
                                <a href="#">Streamline Your Inventory Management</a>
                            </h3>
                            <div class="text">
                            Our Inventory Management System ensures smooth and efficient stock management, designed to handle inventory tasks with ease. From tracking stock levels to generating detailed reports, IMS helps you stay organized and optimize your business operations. With user-friendly features and real-time updates, managing inventory has never been easier.
                            </div>
                            <a href="#" class="main-button">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-post-thumb">
                        <div class="img">
                            <img src="{{ asset('assets/images/blog-item-02.png')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <h3>
                                <a href="#">Efficient Inventory Management</a>
                            </h3>
                            <div class="text">
                            Our IMS offers seamless integration with your business operations. It ensures easy management of stock, orders, and sales, while providing efficient tracking and reporting. With user-friendly interfaces and real-time updates, you can confidently streamline your inventory process, enhance decision-making, and improve overall business performance.
                            </div>
                            <a href="#" class="main-button">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-post-thumb">
                        <div class="img">
                            <img src="{{ asset('assets/images/blog-item-03.png')}}" alt="">
                        </div>
                        <div class="blog-content">
                            <h3>
                                <a href="#">Tailored for B2B and B2C Operations</a>
                            </h3>
                            <div class="text">
                            Our Inventory Management System (IMS) is designed to support both B2B (Business-to-Business) and B2C (Business-to-Consumer) models. For B2B operations, it facilitates bulk order management, supplier tracking, and multi-location inventory management, ensuring smooth transactions between businesses. For B2C, it offers features like real-time stock updates, customer order tracking, and personalized sales reporting to enhance the retail experience.
                            </div>
                            <a href="#" class="main-button">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->

    <!-- ***** Contact Us Start ***** -->
    <section class="section colored" id="contact-us">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Talk To Us</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>We're here to help! Reach out and let us know how we can assist you. No matter your needs, we’re committed to providing support and personalized solutions just for you.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <!-- ***** Contact Text Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="margin-bottom-30">Keep in touch</h5>
                    <div class="contact-text">
                        <p>2 Howard Street, Sheffield,
                        <br>South Yorkshire,
                        <br>S1 4LP, United Kingdom</p>
                        <p>Have questions about our Inventory Management System? We're here to support your business needs. Reach out to learn more about how IMS can streamline your inventory processes, optimize stock management, and enhance operational efficiency. Thank you.</p>
                    </div>
                </div>
                <!-- ***** Contact Text End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="contact-form">
                        <form id="contact" action="" method="get">
                          <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                              <fieldset>
                                <input name="email" type="email" class="form-control" id="email" placeholder="E-Mail Address" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Contact Us End ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">COPYRIGHT © 2024 Inventory Management System. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{asset('assets/js/scrollreveal.min.js')}}"></script>
    <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/imgfix.min.js')}}"></script> 
    
    <!-- Global Init -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

  </body>
</html>