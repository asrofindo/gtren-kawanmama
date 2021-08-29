<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Pages
            <span></span> About
        </div>
    </div>
</div>


<section id="home" class="hero-2 position-relative paralax-area">
    <div class="parallax-wrapper d-lg-block d-none">
        <div class="container">
            <div class="parallax-img-area h-500">
                <div class="parallax-img img-5 wow animate__animated animate__fadeIn">
                    <img class="paralax-5" src="<?= base_url() ?>/frontend/imgs/theme/icons/pattern-1.svg" alt="wowy">
                </div>
                <div class="parallax-img img-6 wow animate__animated animate__fadeIn">
                    <img class="paralax-6" src="<?= base_url() ?>/frontend/imgs/theme/icons/pattern-2.svg" alt="wowy">
                </div>
                <div class="parallax-img img-7 wow animate__animated animate__fade">
                    <img class="paralax-7" src="<?= base_url() ?>/frontend/imgs/theme/icons/pattern-3.svg" alt="wowy">
                </div>
                <div class="parallax-img img-8 wow animate__animated animate__fade">
                    <img class="paralax-8" src="<?= base_url() ?>/frontend/imgs/theme/icons/pattern-4.svg" alt="wowy">
                </div>
            </div>
        </div>
    </div>
    <div class="hero-content">
        <div class="container">
            <div class="text-center">
                <h4 class="text-brand mb-20">About Us</h4>
                <h1 class="mb-30 wow fadeIn animated font-xxl fw-900">
                    We are Experience & Expert<br> to Boost Up your <span class="text-style-1">Business</span>.
                </h1>
                <p class="w-50 m-auto mb-50 wow fadeIn animated">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum quam eius placeat, a quidem mollitia at accusantium reprehenderit pariatur provident nam ratione incidunt magnam sequi.</p>
                <p class="wow fadeIn animated">
                    <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="page-contact.html">Contact Us</a>
                    <a class="btn btn-outline btn-lg btn-brand-outline font-weight-bold text-brand bg-white text-hover-white ml-15 border-radius-5 btn-shadow-brand hover-up">Our Services</a>
                </p>
            </div>
        </div>
    </div>
</section>
<div class="about-count d-md-block d-none">
    <div class="container">
        <div class="about-count-wrap box-shadow-outer-3 border-radius-10 border-1 border-solid border-muted p-40 position-relative z-index-100 bg-white">
            <div class="w-layout-grid achievements-grid">
                <div class="achievement-wrapper">
                    <div class="achievement-number"><span class="count">12</span><span class="text-primary">+</span></div>
                    <div class="achievement-text">Branches Worldwide</div>
                </div>
                <div class="achievement-wrapper">
                    <div class="achievement-number"><span class="count">124</span><span class="text-brand">+</span></div>
                    <div class="achievement-text">Projects Completed</div>
                </div>
                <div class="achievement-wrapper">
                    <div class="achievement-number"><span class="count">145</span><span class="text-brand">+</span></div>
                    <div class="achievement-text">Partners Worldwide</div>
                </div>
                <div class="achievement-wrapper">
                    <div class="achievement-number"><span class="count">15</span>k<span class="text-warning">+</span></div>
                    <div class="achievement-text">Social <br>Follower</div>
                </div>
            </div>
        </div>
    </div>
</div>



<section id="testimonials" class="pt-50 pb-50 mb-30 mt-70">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-12 col-md-12 text-center">
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">Take a look what<br> our clients say about us</h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                    <div class="hero-card-icon icon-left-2 hover-up ">
                        <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="<?= base_url() ?>/frontend/imgs/page/avatar-1.jpg" alt="">
                    </div>
                    <div class="pl-30">
                        <h5 class="mb-5 fw-500">
                            J. Bezos
                        </h5>
                        <p class="font-sm text-grey-5">Adobe Jsc</p>
                        <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                    <div class="hero-card-icon icon-left-2 hover-up ">
                        <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="<?= base_url() ?>/frontend/imgs/page/avatar-3.jpg" alt="">
                    </div>
                    <div class="pl-30">
                        <h5 class="mb-5 fw-500">
                            B.Gates
                        </h5>
                        <p class="font-sm text-grey-5">Adobe Jsc</p>
                        <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                    <div class="hero-card-icon icon-left-2 hover-up ">
                        <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="<?= base_url() ?>/frontend/imgs/page/avatar-2.jpg" alt="">
                    </div>
                    <div class="pl-30">
                        <h5 class="mb-5 fw-500">
                            B. Meyers
                        </h5>
                        <p class="font-sm text-grey-5">Adobe Jsc</p>
                        <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-30">
            <div class="col-12 text-center">
                <p class="wow fadeIn animated">
                    <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg">View More</a>
                </p>
            </div>
        </div>
    </div>
</section>
<section id="clients" class="pt-50 pb-50 bg-brand-muted bg-grey-9">
    <div class="row mb-30">
        <div class="col-lg-12 col-md-12 text-center">
            <h6 class="mt-0 mb-5 text-uppercase font-sm text-brand wow fadeIn animated">Trusted by 50.000+ user</h6>
            <h2 class="mb-5 text-grey-1 wow fadeIn animated">Our Partners</h2>
            <p class="w-50 m-auto font-sm text-grey-3 wow fadeIn animated">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
    </div>
    <div class="container">
        <div class="carausel-6-columns-cover arrow-center position-relative wow fadeIn animated">
            <div class="slider-arrow slider-arrow-3 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
            <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-1.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-2.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-3.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-4.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-5.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-6.png" alt="">
                </div>
                <div class="brand-logo">
                    <img class="img-grey-hover" src="<?= base_url() ?>/frontend/imgs/banner/brand-3.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>