<template>
      
      <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row">
                <div
                    class="
                        col-lg-7
                        d-flex
                        flex-column
                        justify-content-center
                        align-items-stretch
                        order-2 order-lg-1
                    "
                >
                    <div class="content">
                        <h3>

                            {{translate('Why us Eum ipsam laborum deleniti')}}
                            
                            <strong>
                                {{translate('velit pariatur architecto aut nihil')}}
                                
                            </strong>
                        </h3>
                        <p>
                            {{translate('dUMMY TEXT PARAGRAPH')}}
                           
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a
                                    data-bs-toggle="collapse"
                                    class="collapse"
                                    data-bs-target="#accordion-list-1"
                                    ><span>01</span>{{translate('dUMMY TEXT')}}
                                    <i
                                        class="bx bx-chevron-down icon-show"
                                    ></i
                                    ><i
                                        class="bx bx-chevron-up icon-close"
                                    ></i
                                ></a>
                                <div
                                    id="accordion-list-1"
                                    class="collapse show"
                                    data-bs-parent=".accordion-list"
                                >
                                    <p>
                                        {{translate('dUMMY TEXT PARAGRAPH')}}
                                        
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a
                                    data-bs-toggle="collapse"
                                    data-bs-target="#accordion-list-2"
                                    class="collapsed"
                                    ><span>02</span> {{translate('dUMMY TEXT PARAGRAPH')}}
                                    <i
                                        class="bx bx-chevron-down icon-show"
                                    ></i
                                    ><i
                                        class="bx bx-chevron-up icon-close"
                                    ></i
                                ></a>
                                <div
                                    id="accordion-list-2"
                                    class="collapse"
                                    data-bs-parent=".accordion-list"
                                >
                                    <p>
                                        {{translate('dUMMY TEXT PARAGRAPH')}}
                                        
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a
                                    data-bs-toggle="collapse"
                                    data-bs-target="#accordion-list-3"
                                    class="collapsed"
                                    ><span>03</span>{{translate('dUMMY TEXT PARAGRAPH')}} 
                                    <i
                                        class="bx bx-chevron-down icon-show"
                                    ></i
                                    ><i
                                        class="bx bx-chevron-up icon-close"
                                    ></i
                                ></a>
                                <div
                                    id="accordion-list-3"
                                    class="collapse"
                                    data-bs-parent=".accordion-list"
                                >
                                    <p>
                                        {{translate('dUMMY TEXT PARAGRAPH')}}
                                        
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div
                    class="
                        col-lg-5
                        align-items-stretch
                        order-1 order-lg-2
                        img
                    "
                    style="background-image: url('assets/img/why-us.png')"
                    data-aos="zoom-in"
                    data-aos-delay="150"
                >
                    &nbsp;
                </div>
            </div>
        </div>
    </section>

</template>