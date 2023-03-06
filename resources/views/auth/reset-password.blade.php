<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('front_end/assets/css/plugins/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('front_end/assets/css/main.css?v=5.3')}}" />
    <link href="{{asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet" />
</head>

<body>
    <!-- Quick view -->

    @include('front_end.header.quickview')
    <!-- Header  -->
    @include('front_end.header.header')

    <!-- End Header  -->
    <!--End header-->

    <main class="main pages">
      <div class="page-header breadcrumb-wrap">
        <div class="container">
          <div class="breadcrumb">
            <a href="index.html" rel="nofollow"
              ><i class="fi-rs-home mr-5"></i>Home</a
            >
            <span></span> Pages <span></span> My Account
          </div>
        </div>
      </div>
      <div class="page-content pt-150 pb-150">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
              <div class="row">
                <div class="heading_s1">
                  <img
                    class="border-radius-15"
                    src="assets/imgs/page/reset_password.svg"
                    alt=""
                  />
                  <h2 class="mb-15 mt-15">Set new password</h2>
                  <p class="mb-30">
                    Please create a new password that you don’t use on any other
                    site.
                  </p>
                </div>
                <div class="col-lg-6 col-md-8">
                  <div class="login_wrap widget-taber-content background-white">
                    <div class="padding_eight_all bg-white">
                      <form
                        method="POST"
                        action="{{ route('password.store') }}"
                      >
                        @csrf
                        <!-- Password Reset Token -->
                        <input
                          type="hidden"
                          name="token"
                          value="{{ $request->route('token') }}"
                        />
                         <div class="input-group my-4" id="show_hide_password">
                                                <input required="" type="password" name="password" placeholder="Password"  class="form-control border-end-0"
                                                required autocomplete="new-password">
                                                <a
                                                href="javascript:;"
                                                class="input-group-text bg-transparent"
                                                ><i class="bx bx-hide"></i
                                                ></a>
                                            </div>
                                            <div class="input-group " id="showpassword">
                                            <input

                                          required="" type="password" name="password_confirmation" placeholder="Confirm password" class="form-control border-end-0"
                                            required autocomplete="new-password" />
                                             <a
                                                href="javascript:;"
                                                class="input-group-text bg-transparent"
                                                ><i class="bx bx-hide"></i
                                                ></a>
                                            </div>
                        <div class="form-group">
                          <button
                            type="submit"
                            class="btn btn-heading btn-block hover-up"
                            name="login"
                          >
                            Reset password
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 pl-50">
                  <h6 class="mb-15">Password must:</h6>
                  <p>Be between 9 and 64 characters</p>
                  <p>Include at least tow of the following:</p>
                  <ol class="list-insider">
                    <li>An uppercase character</li>
                    <li>A lowercase character</li>
                    <li>A number</li>
                    <li>A special character</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    @include('front_end.footer.footer')
    <!-- Preloader Start -->
    {{-- <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="text-center">
            <img src="assets/imgs/theme/loading.gif" alt="" />
          </div>
        </div>
      </div>
    </div> --}}
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
    <!--Password show & hide js -->
    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on("click", function (event) {
          event.preventDefault();
          if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("bx-hide");
            $("#show_hide_password i").removeClass("bx-show");
          } else if (
            $("#show_hide_password input").attr("type") == "password"
          ) {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("bx-hide");
            $("#show_hide_password i").addClass("bx-show");
          }
        });
        $("#showpassword a").on("click", function (event) {
          event.preventDefault();
          if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("bx-hide");
            $("#show_hide_password i").removeClass("bx-show");
          } else if (
            $("#show_hide_password input").attr("type") == "password"
          ) {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("bx-hide");
            $("#show_hide_password i").addClass("bx-show");
          }
        });
      });
    </script>
  </body>
</html>
