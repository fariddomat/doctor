@extends('layouts.site')
@section('title', setting('site_title'))
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to {{ setting('site_name') }}</h1>
            <h2>{{ setting('site_about') }}</h2>
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Why Choose {{ setting('site_name') }}?</h3>
                            {!! setting('site_why_choose') !!}

                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-calendar"></i>
                                        <h4>Appointments Calendar</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Best Service</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <h4>New Tools</h4>

                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">

                <div class="row">
                    <div
                        class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                    </div>

                    <div
                        class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                        <h3>About DrSmile</h3>
                        {!! setting('site_about_doctor') !!}

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-time"></i></div>
                            <h4 class="title">Always On Time</h4>
                            <p class="description">Timing is my main concern</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-speaker"></i></div>
                            <h4 class="title">Give Attention</h4>
                            <p class="description">Listen to patient and let them take there time</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-atom"></i></div>
                            <h4 class="title"><a href="">Continues Learning</a></h4>
                            <p class="description">Get information as soon as posible about new treatments</p>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="fas fa-user-plus"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $patients }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Patient</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="far fa-hospital"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $appointments }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Appointments</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-flask"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $types }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Types</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-award"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ setting('site_awards_count') }}" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Awards</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>Services</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">
                    @for ($i = 1; $i <= 6; $i++)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch  mt-4 mb-2">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-{{ setting('service_icon_' . $i) }}"></i></div>
                            <h4><a href="">{{ setting('title' . $i) }}</a></h4>
                            <p>{{ setting('service_content_' . $i) }}</p>
                        </div>
                    </div>
                    @endfor

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors">
        <div class="container">

          <div class="section-title">
            <h2>Doctors</h2>
            </div>

          <div class="row">

            @foreach ($doctors as $doctor)
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>{{ $doctor->name }}</h4>
                    <span>Anesthesiologist</span>
                    <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                    <div class="social">
                      <a href=""><i class="ri-twitter-fill"></i></a>
                      <a href=""><i class="ri-facebook-fill"></i></a>
                      <a href=""><i class="ri-instagram-fill"></i></a>
                      <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach



          </div>

        </div>
      </section><!-- End Doctors Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="faq-list">
                    <ul>
                        @for ($i=1; $i<=5; $i++)

                        <li data-aos="fade-up" data-aos-delay="{{ ($i-1)*100 }}">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-{{ $i }}" class="collapsed">{{ setting('question_'.$i) }}
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-{{ $i }}" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    {{ setting('answer_'.$i) }}
                                </p>
                            </div>
                        </li>
                        @endfor


                    </ul>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container">

                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row g-0">

                    @for ($i=1 ; $i<=8 ; $i++)
                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/images/gallery/image_'.$i.'.jpg') }}" class="galelry-lightbox">
                                <img src="{{ asset('home/images/gallery/image_'.$i.'.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    @endfor


                </div>

            </div>
        </section><!-- End Gallery Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">


            <div>
                {!! setting('site_location') !!}
            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
