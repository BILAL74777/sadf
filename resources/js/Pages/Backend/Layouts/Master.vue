<template>
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"
    />

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div
            class="d-flex align-items-center justify-content-between c-logo-box"
        >
            <Link :href="route('dashboard')">
                <img src="/images/logo.png" height="60" alt="logo" />
                <!-- <span class="d-none d-lg-block"> Portfolio Cast </span> -->
            </Link>
            <i
                class="bi bi-list toggle-sidebar-btn"
                @click="sidebarToggle()"
            ></i>
        </div>
        <!-- End Logo -->

        <!-- <a class="nav-link nav-icon" :href="route('home')" target="_blank" title="Browse Website">
        <i class="bi bi-globe"></i>
    </a> -->

        <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>End Search Icon -->

                <!-- <li class="nav-item dropdown"> -->

                <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>End Notification Icon -->

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul> -->
                <!-- End Notification Dropdown Items -->

                <!-- </li>End Notification Nav -->

                <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a> End Messages Icon 

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="/backend/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="/backend/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="/backend/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul> End Messages Dropdown Items 

        </li>End Messages Nav -->

                <li class="nav-item dropdown pe-3">
                    <a
                        class="nav-link nav-profile d-flex align-items-center pe-0"
                        href="#"
                        data-bs-toggle="dropdown"
                    >
                        <img
                            :src="$page.props.user.profile_photo_url"
                            alt="Profile"
                            class="rounded-circle"
                            @error="setAltImg"
                        />
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{
                            $page.props.user.name
                        }}</span> </a
                    ><!-- End Profile Iamge Icon -->

                    <ul
                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                    >
                        <!-- <li class="dropdown-header">
              <h6>{{$page.props.user.name}}</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

                        <li v-if="$page.props.user.role == 'user'">
                            <Link
                                class="dropdown-item d-flex align-items-center"
                                :href="route('profile')"
                            >
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </Link>
                        </li>
                        <!-- <li>
              <hr class="dropdown-divider">
            </li> -->

                        <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li> -->
                        <!-- <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li> -->
                        <!-- <li>
              <hr class="dropdown-divider">
            </li> -->

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                @click="logout"
                                href="javascript:;"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                        <li>
                            <Link
                                class="dropdown-item d-flex align-items-center"
                                :href="route('profile')"
                            >
                                <i class="bi bi-plus-lg"></i>
                                <span>Update Profile</span>
                            </Link>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul
            class="sidebar-nav"
            id="sidebar-nav"
            v-if="$page.props.user.role == 'admin'"
        >
            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('dashboard')"
                    :class="{ collapsed: !$page.url.startsWith('/dashboard') }"
                >
                    <i class="bi bi-speedometer"></i>
                    <span>{{ translate("Dashboard") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('company')"
                    :class="{ collapsed: !$page.url.startsWith('/company') }"
                >
                    <i class="bi bi-building"></i>
                    <span>{{ translate("Company") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('customer')"
                    :class="{ collapsed: !$page.url.startsWith('/customer') }"
                >
                    <i class="bi bi-people"></i>
                    <span>{{ translate("Customer") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('address')"
                    :class="{ collapsed: !$page.url.startsWith('/address') }"
                >
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>{{ translate("Address") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('unit')"
                    :class="{ collapsed: !$page.url.startsWith('/unit') }"
                >
                    <i class="bi bi-bell"></i>
                    <span>{{ translate("Unit") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('contact')"
                    :class="{ collapsed: !$page.url.startsWith('/contact') }"
                >
                    <i class="bi bi-person-lines-fill"></i>
                    <span>{{ translate("Contact") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('lesson')"
                    :class="{ collapsed: !$page.url.startsWith('/lesson') }"
                >
                    <i class="bi bi-person-lines-fill"></i>
                    <span>{{ translate("Lessons") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('task')"
                    :class="{ collapsed: !$page.url.startsWith('/task') }"
                >
                    <i class="bi bi-list-task"></i>
                    <span>{{ translate("Task") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('user')"
                    :class="{ collapsed: !$page.url.startsWith('/user') }"
                >
                    <i class="bi bi-gear"></i>
                    <span>User's</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('chart')"
                    :class="{ collapsed: !$page.url.startsWith('/chart') }"
                >
                    <i class="bi bi-gear"></i>
                    <span>Chart</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('calender')"
                    :class="{ collapsed: !$page.url.startsWith('/calender') }"
                >
                    <i class="bi bi-gear"></i>
                    <span>Calender</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('events')"
                    :class="{ collapsed: !$page.url.startsWith('/events') }"
                >
                    <i class="bi bi-calendar2-event"></i>
                    <span>{{ translate("Events") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('collector')"
                    :class="{ collapsed: !$page.url.startsWith('/collector') }"
                >
                    <i class="bi bi-gear"></i>
                    <span>Collectors</span>
                </Link>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#icons-nav"
                    data-bs-toggle="collapse"
                    href="#"
                >
                    <i class="bi bi-grid"></i><span>Settings</span
                    ><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="icons-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                >
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('training')"
                            :class="{
                                collapsed: !$page.url.startsWith('/training'),
                            }"
                        >
                            <i class="bi bi-gear"></i>
                            <span>Training</span>
                        </Link>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('external-website')"
                    :class="{
                        collapsed: !$page.url.startsWith('/external-website'),
                    }"
                >
                    <i class="bi bi-globe"></i>
                    <span>{{ translate("External Website") }}</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('trainings_for_certificates')"
                    :class="{
                        collapsed: !$page.url.startsWith(
                            '/trainings_for_certificates'
                        ),
                    }"
                >
                    <i class="bi bi-gear"></i>
                    <span>Training</span>
                </Link>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#icons-nav-emails"
                    data-bs-toggle="collapse"
                    href="#"
                >
                    <i class="bi bi-grid"></i><span>Emails</span
                    ><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="icons-nav-emails"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                >
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('welcome.email')"
                            :class="{
                                collapsed:
                                    !$page.url.startsWith('/welcome.email'),
                            }"
                        >
                            <i class="bi bi-gear"></i>
                            <span>Welcome email</span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('reset-password-email')"
                            :class="{
                                collapsed: !$page.url.startsWith(
                                    '/reset-password-email'
                                ),
                            }"
                        >
                            <i class="bi bi-gear"></i>
                            <span>Reset password email</span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('collection-email')"
                            :class="{
                                collapsed:
                                    !$page.url.startsWith('/collection-email'),
                            }"
                        >
                            <i class="bi bi-gear"></i>
                            <span>Collection email</span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('weekly-report-email')"
                            :class="{
                                collapsed: !$page.url.startsWith(
                                    '/weekly-report-email'
                                ),
                            }"
                        >
                            <i class="bi bi-gear"></i>
                            <span>Weekly report email</span>
                        </Link>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <Link
                    class="nav-link"
                    :href="route('quiz')"
                    :class="{
                        collapsed: !$page.url.startsWith(
                            '/quiz'
                        ),
                    }"
                >
                    <i class="bi bi-gear"></i>
                    <span>Quiz</span>
                </Link>
            </li>
            <!-- 
      <li class="nav-item">
        <Link class="nav-link" :href="route('languages')" :class="{'collapsed': !$page.url.startsWith('/languages') }">
          <i class="bi bi-gear"></i>
          <span>Languages</span>
         </Link>
      </li> -->
        </ul>

        <!-- the below nav's are for users  -->
        <ul
            class="sidebar-nav"
            id="sidebar-nav"
            v-if="$page.props.user.role == 'user'"
        >
            <li class="nav-item" v-if="talent_inquiry != 'UnRegistered'">
                <Link
                    class="nav-link"
                    :href="route('talents-profile')"
                    :class="{
                        collapsed: !$page.url.startsWith('/talents-profile'),
                    }"
                >
                    <i class="bi bi-people-fill"></i>
                    <span> {{ translate("Talent Profile") }}</span>
                </Link>
            </li>
            <li class="nav-item" v-if="talent_inquiry != 'UnRegistered'">
                <Link
                    class="nav-link"
                    :href="route('talents-project-selections')"
                    :class="{
                        collapsed: !$page.url.startsWith(
                            '/talents-project-selections'
                        ),
                    }"
                >
                    <i class="bi bi-journals"></i>
                    <span> {{ translate("Projects") }}</span>
                </Link>
            </li>

            <li class="nav-item" v-if="talent_inquiry != 'UnRegistered'">
                <Link
                    class="nav-link"
                    :href="route('applied-projects')"
                    :class="{
                        collapsed: !$page.url.startsWith('/applied-projects'),
                    }"
                >
                    <i class="bi bi-journal-check"></i>
                    <span> {{ translate("Applied Projects") }}</span>
                </Link>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar-->

    <!-- added other pages code here -->
    <slot></slot>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>CRM</span></strong
            >. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
    </footer>
    <!-- End Footer -->

    <a
        href="javascript:void(0)"
        :class="{ active: backToTopActive }"
        class="back-to-top d-flex align-items-center justify-content-center"
        @click="toTop"
        ><i class="bi bi-arrow-up-short"></i
    ></a>
</template>

<script>
export default {
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    props: ["talent_inquiry"],
    created() {
        // console.log(this.talent_inquiry);
    },
    data() {
        return {
            backToTopActive: 0,
        };
    },
    methods: {
        handleScroll: function () {
            if (window.scrollY > 0) {
                this.backToTopActive = 1;
            } else {
                this.backToTopActive = 0;
            }
        },
        toTop: function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        },

        sidebarToggle() {
            document.body.classList.toggle("toggle-sidebar");
        },
        logout() {
            // console.log(this.$page.props.auth_token);
            axios
                .post(route("api.logout"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    // toastr.success("You are successfully logged out.");
                    // this.$inertia.get(route('login'));
                    window.location.replace(route("login"));
                })
                .catch((error) => {
                    // console.log(error);
                    // toastr.error(error.response.data.message);
                });
        },
        setAltImg(event) {
            event.target.src = "/images/default.jpg";
        },
    },
};
</script>

<style>
@import "~/backend/assets/vendor/bootstrap/css/bootstrap.min.css";
@import "~/backend/assets/vendor/bootstrap-icons/bootstrap-icons.css";
@import "~/backend/assets/vendor/remixicon/remixicon.css";
@import "~/backend/assets/vendor/boxicons/css/boxicons.min.css";
@import "~/backend/assets/vendor/quill/quill.snow.css";
@import "~/backend/assets/vendor/quill/quill.bubble.css";
@import "~/backend/assets/vendor/simple-datatables/style.css";
@import "~/backend/assets/css/style.css";
@import "toastr";

body {
    /* background: #b4b4b5; */
    color: #30312f;
}

.btn-success {
    background-color: #ed2124;
}

.btn-success:hover {
    background-color: #ed2124;
}

.sidebar-nav .nav-link.collapsed {
    color: #30312f;
}

.sidebar-nav .nav-link {
    color: #ed2124;
}

.sidebar-nav .nav-link i {
    color: #ed2124;
}

.sidebar-nav .nav-link:hover {
    color: #ed2124;
}
.sidebar-nav .nav-link:hover i {
    color: #ed2124;
}

.back-to-top {
    background: #ed2124;
}

.back-to-top:hover {
    background: #ed2124;
}

.btn-dark {
    background-color: #30312f;
}
.btn-secondary {
    background-color: #b4b4b5;
}
.text-dark {
    color: #30312f !important;
}
.pagetitle h1 {
    color: #30312f !important;
}
.table-striped > tbody > tr:nth-of-type(odd) > * {
    color: #30312f !important;
}

@media (min-width: 992px) {
    .c-logo-box {
        width: 300px;
    }
}

#header {
    background-color: #f7f7f7 !important;
}

/* some text */
</style>
