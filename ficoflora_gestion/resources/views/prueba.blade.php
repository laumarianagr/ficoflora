<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">


    <link rel="stylesheet" href="{{ asset('css/base.css')}}">
    <link rel="stylesheet" href="{{ asset('css/extras.css')}}">


    <script type='text/javascript' src='{{ asset('plugins/modernizr/modernizr.js')}}'></script>



</head>
<body>
<div class="p-container">

    <!-- start: header -->
    <header class="p-header">
        <div class="logo-container">
            <a href="../" class="logo">
                <img src="{{ asset('img/logo.png')}}" height="35" alt="Porto Admin" />
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="p-header-right">


            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="{{ asset('img/!logged-user.jpg')}}" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                    </figure>
                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                        <span class="name">John Doe Junior</span>
                        <span class="role">administrator</span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

    <div class="p-body">
        <!-- start: sidebar -->
        <div id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
                <div class="sidebar-title">
                    Navigation
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <li class="nav-active">
                                <a href="index.html">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailbox-folder.html">
                                    <span class="pull-right label label-primary">182</span>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>Mailbox</span>
                                </a>
                            </li>
                            <li class="nav-parent">
                                <a>
                                    <i class="fa fa-copy" aria-hidden="true"></i>
                                    <span>Pages</span>
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a href="pages-signup.html">
                                            Sign Up
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-signin.html">
                                            Sign In
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-recover-password.html">
                                            Recover Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-lock-screen.html">
                                            Locked Screen
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-user-profile.html">
                                            User Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-session-timeout.html">
                                            Session Timeout
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-calendar.html">
                                            Calendar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-timeline.html">
                                            Timeline
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-media-gallery.html">
                                            Media Gallery
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-invoice.html">
                                            Invoice
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-blank.html">
                                            Blank Page
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-404.html">
                                            404
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-500.html">
                                            500
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-log-viewer.html">
                                            Log Viewer
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pages-search-results.html">
                                            Search Results
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            </li>
                        </ul>
                    </nav>

                    <hr class="separator" />



                </div>

            </div>

        </div>
        <!-- end: sidebar -->

        <div class="p-content" role="main">
            <header class="content-header">
                <h2>Dashboard</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.html">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Dashboard</span></li>
                    </ol>

                </div>
            </header>


                    <!-- start: page -->
                    <h3 class="mt-none">Block Widgets</h3>
                    <p>Block Widgets are perfect to show some statistics.</p>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Default</h5>
                            <section class="visible-md panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-xlg">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="hidden-md panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-xlg">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-md">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-sm">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary widget-summary-xs">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Icon Colors</h5>
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-secondary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-secondary">
                                                <i class="fa fa-usd"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total Profit</h4>
                                                <div class="info">
                                                    <strong class="amount">$ 14,890.30</strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(withdraw all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Today's Orders</h4>
                                                <div class="info">
                                                    <strong class="amount">38</strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(statement)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel panel-featured-left panel-featured-quartenary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-quartenary">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Today's Visitors</h4>
                                                <div class="info">
                                                    <strong class="amount">3765</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(report)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4">
                            <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Box Colors</h5>
                            <div class="row">
                                <div class="col-md-6 col-xl-12">
                                    <section class="panel">
                                        <div class="panel-body bg-primary">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon">
                                                        <i class="fa fa-life-ring"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">Support Questions</h4>
                                                        <div class="info">
                                                            <strong class="amount">1281</strong>
                                                        </div>
                                                    </div>
                                                    <div class="summary-footer">
                                                        <a class="text-uppercase">(view all)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-6 col-xl-12">
                                    <section class="panel">
                                        <div class="panel-body bg-secondary">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon">
                                                        <i class="fa fa-life-ring"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">Support Questions</h4>
                                                        <div class="info">
                                                            <strong class="amount">1281</strong>
                                                        </div>
                                                    </div>
                                                    <div class="summary-footer">
                                                        <a class="text-uppercase">(view all)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-6 col-xl-12">
                                    <section class="panel">
                                        <div class="panel-body bg-tertiary">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon">
                                                        <i class="fa fa-life-ring"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">Support Questions</h4>
                                                        <div class="info">
                                                            <strong class="amount">1281</strong>
                                                        </div>
                                                    </div>
                                                    <div class="summary-footer">
                                                        <a class="text-uppercase">(view all)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-6 col-xl-12">
                                    <section class="panel">
                                        <div class="panel-body bg-quartenary">
                                            <div class="widget-summary">
                                                <div class="widget-summary-col widget-summary-col-icon">
                                                    <div class="summary-icon">
                                                        <i class="fa fa-life-ring"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-summary-col">
                                                    <div class="summary">
                                                        <h4 class="title">Support Questions</h4>
                                                        <div class="info">
                                                            <strong class="amount">1281</strong>
                                                        </div>
                                                    </div>
                                                    <div class="summary-footer">
                                                        <a class="text-uppercase">(view all)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Border Color Positions</h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel panel-featured-top panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel panel-featured-right panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel panel-featured-bottom panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-life-ring"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Support Questions</h4>
                                                <div class="info">
                                                    <strong class="amount">1281</strong>
                                                    <span class="text-primary">(14 unread)</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-muted text-uppercase">(view all)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <h3 class="mt-lg">Content Widgets</h3>
                    <p class="mb-lg">Content Widgets are perfect to show text information.</p>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel">
                                <header class="panel-heading bg-white">
                                    <div class="panel-heading-icon bg-primary mt-sm">
                                        <i class="fa fa-rocket"></i>
                                    </div>
                                </header>
                                <div class="panel-body">
                                    <h3 class="text-semibold mt-none text-center">Simple Block Title</h3>
                                    <p class="text-center">Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</p>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <section class="panel">
                                <header class="panel-heading bg-primary">
                                    <div class="panel-heading-icon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                </header>
                                <div class="panel-body text-center">
                                    <h3 class="text-semibold mt-sm text-center">Simple Block Title</h3>
                                    <p class="text-center">Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</p>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-6">
                            <section class="panel panel-horizontal">
                                <header class="panel-heading bg-white">
                                    <div class="panel-heading-icon bg-primary mt-sm">
                                        <i class="fa fa-music"></i>
                                    </div>
                                </header>
                                <div class="panel-body p-lg">
                                    <h3 class="text-semibold mt-sm">Simple Block Title</h3>
                                    <p>Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes.</p>
                                </div>
                            </section>
                            <section class="panel panel-horizontal">
                                <header class="panel-heading bg-primary">
                                    <div class="panel-heading-icon">
                                        <i class="fa fa-music"></i>
                                    </div>
                                </header>
                                <div class="panel-body p-lg">
                                    <h3 class="text-semibold mt-sm">Simple Block Title</h3>
                                    <p>Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes.</p>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mt-lg">User Widgets</h3>
                                    <p class="mb-lg">Widgets for user actions.</p>

                                    <section class="panel-group mb-xlg">
                                        <div class="widget-twitter-profile">
                                            <div class="top-image">
                                                <img src="assets/images/widget-twitter-profile.jpg" alt="">
                                            </div>
                                            <div class="profile-info">
                                                <div class="profile-picture">
                                                    <img src="assets/images/!logged-user.jpg" alt="">
                                                </div>
                                                <div class="profile-account">
                                                    <h3 class="name text-semibold">John Doe</h3>
                                                    <a href="#" class="account">@oklerthemes</a>
                                                </div>
                                                <ul class="profile-stats">
                                                    <li>
                                                        <h5 class="stat text-uppercase">Tweets</h5>
                                                        <h4 class="count">60</h4>
                                                    </li>
                                                    <li>
                                                        <h5 class="stat text-uppercase">Following</h5>
                                                        <h4 class="count">139</h4>
                                                    </li>
                                                    <li>
                                                        <h5 class="stat text-uppercase">Followers</h5>
                                                        <h4 class="count">38</h4>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="profile-quote">
                                                <blockquote>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dapibus consectetur aliquet. Curabitur tincidunt convallis mi, ac elementum purus bibendum vitae.
                                                    </p>
                                                </blockquote>
                                                <div class="quote-footer">
                                                    <span class="datetime">4:27 PM - 15 Jul 2014</span>
                                                    -
                                                    <a href="#">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <section class="panel panel-group">
                                        <header class="panel-heading bg-primary">

                                            <div class="widget-profile-info">
                                                <div class="profile-picture">
                                                    <img src="assets/images/!logged-user.jpg">
                                                </div>
                                                <div class="profile-info">
                                                    <h4 class="name text-semibold">John Doe</h4>
                                                    <h5 class="role">Administrator</h5>
                                                    <div class="profile-footer">
                                                        <a href="#">(edit profile)</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </header>
                                        <div id="accordion">
                                            <div class="panel panel-accordion panel-accordion-first">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                                                            <i class="fa fa-check"></i> Tasks
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1One" class="accordion-body collapse in">
                                                    <div class="panel-body">
                                                        <ul class="widget-todo-list">
                                                            <li>
                                                                <div class="checkbox-custom checkbox-default">
                                                                    <input type="checkbox" checked="" id="todoListItem1" class="todo-check">
                                                                    <label class="todo-label" for="todoListItem1"><span>Lorem ipsum dolor sit amet</span></label>
                                                                </div>
                                                                <div class="todo-actions">
                                                                    <a class="todo-remove" href="#">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox-custom checkbox-default">
                                                                    <input type="checkbox" id="todoListItem2" class="todo-check">
                                                                    <label class="todo-label" for="todoListItem2"><span>Lorem ipsum dolor sit amet</span></label>
                                                                </div>
                                                                <div class="todo-actions">
                                                                    <a class="todo-remove" href="#">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox-custom checkbox-default">
                                                                    <input type="checkbox" id="todoListItem3" class="todo-check">
                                                                    <label class="todo-label" for="todoListItem3"><span>Lorem ipsum dolor sit amet</span></label>
                                                                </div>
                                                                <div class="todo-actions">
                                                                    <a class="todo-remove" href="#">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-accordion">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                                            <i class="fa fa-comment"></i> Messages
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1Two" class="accordion-body collapse">
                                                    <div class="panel-body">
                                                        <ul class="simple-user-list mb-xlg">
                                                            <li>
                                                                <figure class="image rounded">
                                                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                                                                </figure>
                                                                <span class="title">Joseph Doe Junior</span>
                                                                <span class="message">Lorem ipsum dolor sit.</span>
                                                            </li>
                                                            <li>
                                                                <figure class="image rounded">
                                                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle">
                                                                </figure>
                                                                <span class="title">Joseph Junior</span>
                                                                <span class="message">Lorem ipsum dolor sit.</span>
                                                            </li>
                                                            <li>
                                                                <figure class="image rounded">
                                                                    <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle">
                                                                </figure>
                                                                <span class="title">Joe Junior</span>
                                                                <span class="message">Lorem ipsum dolor sit.</span>
                                                            </li>
                                                            <li>
                                                                <figure class="image rounded">
                                                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
                                                                </figure>
                                                                <span class="title">Joseph Doe Junior</span>
                                                                <span class="message">Lorem ipsum dolor sit.</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <section class="panel">
                                        <header class="panel-heading bg-tertiary">
                                            <div class="panel-heading-profile-picture">
                                                <img src="assets/images/!logged-user.jpg">
                                            </div>
                                        </header>
                                        <div class="panel-body">
                                            <h4 class="text-semibold mt-sm">John Doe</h4>
                                            <p>Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. </p>
                                            <hr class="solid short">
                                            <p><a href="#"><i class="fa fa-user mr-xs"></i> My Profile</a></p>
                                            <p><a href="#"><i class="fa fa-lock mr-xs"></i> Lock Screen</a></p>
                                            <p><a href="#"><i class="fa fa-power-off mr-xs"></i> Logout</a></p>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mt-lg">Graph Widgets</h3>
                                    <p class="mb-lg">Add graphs in widgets and show extra information.</p>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <section class="panel panel-featured panel-featured-primary">
                                        <div class="panel-body">
                                            <div class="chart chart-sm" id="flotWidgetsSales1"></div>
                                            <script>

                                                var flotWidgetsSales1Data = [{
                                                    data: [
                                                        ["Jan", 140],
                                                        ["Feb", 240],
                                                        ["Mar", 190],
                                                        ["Apr", 140],
                                                        ["May", 180],
                                                        ["Jun", 320],
                                                        ["Jul", 270],
                                                        ["Aug", 180]
                                                    ],
                                                    color: "#0088cc"
                                                }];

                                            </script>
                                            <hr class="solid short mt-lg">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="h4 text-bold mb-none mt-lg">488</div>
                                                    <p class="text-xs text-muted mb-none">Total Sales</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="h4 text-bold mb-none mt-lg">$1000</div>
                                                    <p class="text-xs text-muted mb-none">Profit</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="h4 text-bold mb-none mt-lg">123</div>
                                                    <p class="text-xs text-muted mb-none">Comments</p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <section class="panel">
                                        <div class="panel-body bg-primary">

                                            <div class="chart chart-sm" id="morrisLine"></div>
                                            <script type="text/javascript">

                                                var morrisLineData = [{
                                                    y: '2009',
                                                    a: 70
                                                }, {
                                                    y: '2010',
                                                    a: 80
                                                }, {
                                                    y: '2011',
                                                    a: 35
                                                }, {
                                                    y: '2012',
                                                    a: 95
                                                }, {
                                                    y: '2013',
                                                    a: 120
                                                }, {
                                                    y: '2014',
                                                    a: 200
                                                }];

                                            </script>
                                        </div>
                                    </section>
                                    <section class="panel">
                                        <div class="panel-body">
                                            <div class="small-chart pull-right" id="sparklineBar"></div>
                                            <script type="text/javascript">
                                                var sparklineBarData = [5, 6, 7, 2, 0, 4 , 2, 4, 2, 0, 4 , 2, 4, 2, 0, 4];
                                            </script>
                                            <div class="h4 text-bold mb-none">488</div>
                                            <p class="text-xs text-muted mb-none">Nullam quis ris</p>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mt-lg">Misc Widgets</h3>
                                    <p class="mb-lg">Customizable widgets.</p>

                                    <section class="panel">
                                        <div class="panel-body panel-body-nopadding">
                                            <div class="owl-carousel mb-md" data-plugin-carousel data-plugin-options='{ "items": 1, "autoHeight": true }'>
                                                <div class="item">
                                                    <img alt="" class="img-responsive img-rounded" src="assets/images/blog-image-3.jpg">
                                                </div>
                                                <div class="item">
                                                    <img alt="" class="img-responsive img-rounded" src="assets/images/blog-image-2.jpg">
                                                </div>
                                                <div class="item">
                                                    <img alt="" class="img-responsive img-rounded" src="assets/images/blog-image-1.jpg">
                                                </div>
                                            </div>
                                            <div class="p-md">
                                                <h4 class="text-semibold mt-none">Simple Block Title</h4>
                                                <p>Nullam quiris risus eget urna mollis ornare vel eu leo. Cum soccis natoque penatibus et magnis dis parturient montes. Urna mollis ornare vel eu leo. Cum soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</p>
                                            </div>
                                        </div>
                                        <div class="panel-footer panel-footer-btn-group">
                                            <a href="#"><i class="fa fa-user mr-xs"></i> My Profile</a>
                                            <a href="#"><i class="fa fa-lock mr-xs"></i> Lock Screen</a>
                                            <a href="#"><i class="fa fa-power-off mr-xs"></i> Logout</a>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: page -->
                </div>
            </div>

            <!-- end: page -->
        </div>
    </div>


</div>



<script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
<script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>

<script type='text/javascript' src='{{ asset('plugins/nanoscroller/nanoscroller.js')}}'></script>
<script type='text/javascript' src='{{ asset('js/theme.js')}}'></script>



</body>
</html>