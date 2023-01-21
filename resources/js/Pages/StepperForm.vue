<template>
    <Head>
        <!-- <title>Home Component</title> -->
        <title>{{ seo.title }}</title>

        <meta name="keywords" :content="seo.keyword" />
        <meta name="image" :content="'/storage/' + seo.image" />
        <meta name="description" :content="seo.description" />

        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>

    <section class="py-0">
        <div class="card c-form-card c-bg-theme-black">
            <div class="card-body pt-5">
                <form @submit.prevent="submit" id="regForm">
                    <div class="row pb-5">
                        <div v-if="activePhase == 1">
                            <!-- General info group  -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Film Information") }}
                                </div>
                                <div class="card-body pt-4">
                                    
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="original_title"
                                                >{{
                                                    translate("Original Title")
                                                }} </label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="sponsor"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.original_title,
                                                }"
                                                v-model="form.original_title"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.original_title"
                                            >
                                                {{
                                                    formErrors.original_title[0]
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="length">{{
                                                translate("Length (Minutes)")
                                            }}</label>
                                            <Slider
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.length,
                                                }"
                                                v-model="form.length"
                                                :max="300"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.length"
                                            >
                                                {{ formErrors.length[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="director">{{
                                                translate("Director")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="director"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.director,
                                                }"
                                                v-model="form.director"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.director"
                                            >
                                                {{ formErrors.director[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Director Gender")
                                            }}</label>
                                            <Multiselect
                                                v-model="form.director_sex"
                                                :placeholder="
                                                    translate('Director Gender')
                                                "
                                                :options="Gender_options"
                                                :searchable="true"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.director_sex,
                                                }"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.director_sex"
                                            >
                                                {{ formErrors.director_sex[0] }}
                                            </div>
                                        </div>

                                        <!-- <div class="col-12 col-md-6">
                                            <label for="title_in_translation">{{ translate("Title in translation")
                                            }}</label>
                                            <input type="text" class="form-control" id="sponsor"
                                                :class="{ 'invalid-bg': formErrors.title_in_translation }"
                                                v-model="form.title_in_translation" />

                                            <div class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.title_in_translation">
                                                {{ formErrors.title_in_translation[0] }}
                                            </div>
                                        </div> -->

                                        <div>
                                            <div
                                                class="row"
                                                v-for="(
                                                    list, index
                                                ) in TitleInTranslateList"
                                                :key="index"
                                            >
                                                <div class="col-12 col-md-8">
                                                    <label>
                                                        {{ translate("Title in translation") }}
                                                         ({{ translate('optional') }})
                                                    </label>
                                                    <div class="c-input-group">
                                                        <button
                                                            v-if="index > 0"
                                                            class="btn"
                                                            @click="
                                                                removeList(
                                                                    index,
                                                                    list
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="bi bi-trash"
                                                            ></i>
                                                        </button>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            :class="{
                                                                'invalid-bg':
                                                                    formErrors.title_in_translation,
                                                            }"
                                                            v-model="
                                                                list.title_in_translation
                                                            "
                                                        />
                                                    </div>
                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.title_in_translation
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .title_in_translation[0]
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label
                                                        :class="
                                                            index > 0
                                                                ? 'c-ms-2-7'
                                                                : ''
                                                        "
                                                        >{{
                                                            translate(
                                                                "Language"
                                                            )
                                                        }}
                                                         ({{ translate('optional') }})
                                                        </label
                                                    >
                                                    <div class="c-input-group">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            :class="{
                                                                'invalid-bg':
                                                                    formErrors.multi_language,
                                                            }"
                                                            v-model="
                                                                list.multi_language
                                                            "
                                                        />

                                                        <span
                                                            @click="addList"
                                                            class="btn btn-success ms-1"
                                                        >
                                                            +
                                                        </span>
                                                    </div>

                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.multi_language
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .multi_language[0]
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <label>
                                                        {{
                                                            translate(
                                                                "Year of completion"
                                                            )
                                                        }}
                                                    </label>
                                                    <Datepicker
                                                    autoApply
                                                        :enableTimePicker="
                                                            false
                                                        "
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.year_of_completion,
                                                        }"
                                                        v-model="
                                                            form.year_of_completion
                                                        "
                                                        yearPicker
                                                        :yearRange="getYearRange()"
                                                    >
                                                    </Datepicker>
                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.year_of_completion
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .year_of_completion[0]
                                                        }}
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <label>
                                                        {{
                                                            translate(
                                                                "Year of release"
                                                            )
                                                        }}
                                                    </label>
                                                    <Datepicker
                                                    autoApply
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.year_of_release,
                                                        }"
                                                        v-model="
                                                            form.year_of_release
                                                        "
                                                        yearPicker
                                                        :yearRange="getYearRange()"
                                                    >
                                                    </Datepicker>
                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.year_of_release
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .year_of_release[0]
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <label>{{
                                                        translate("Film Type")
                                                    }}</label>
                                                    <Multiselect
                                                        v-model="form.type"
                                                        :options="
                                                            filmType_options
                                                        "
                                                        :placeholder="
                                                            translate(
                                                                'Film Type'
                                                            )
                                                        "
                                                        :searchable="true"
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.type,
                                                        }"
                                                    />
                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="formErrors.type"
                                                    >
                                                        {{ formErrors.type[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="contact">{{
                                                        translate(
                                                            "Contact Name"
                                                        )
                                                    }}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="contact"
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.contact,
                                                        }"
                                                        v-model="form.contact"
                                                    />

                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.contact
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .contact[0]
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <label for="trailer_link">{{
                                                        translate(
                                                            "Trailer link"
                                                        )
                                                    }}
                                                 ({{ translate('optional') }})    
                                                </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="sponsor"
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.trailer_link,
                                                        }"
                                                        v-model="
                                                            form.trailer_link
                                                        "
                                                    />

                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.trailer_link
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .trailer_link[0]
                                                        }}
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <label for="film_link">{{
                                                        translate("Film link")
                                                    }}</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="sponsor"
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.film_link,
                                                        }"
                                                        v-model="form.film_link"
                                                    />

                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="
                                                            formErrors.film_link
                                                        "
                                                    >
                                                        {{
                                                            formErrors
                                                                .film_link[0]
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Exhibition channel")
                                            }}</label>
                                            <Multiselect
                                                v-model="form.endpoint"
                                                :options="Endpoint_options"
                                                :placeholder="
                                                    translate('Choose')
                                                "
                                                mode="tags"
                                                :searchable="true"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.endpoint,
                                                }"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.endpoint"
                                            >
                                                {{ formErrors.endpoint[0] }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label
                                                >{{ translate("Production") }}
                                                 </label
                                            >
                                            <Multiselect
                                                v-model="form.direction"
                                                :options="Direction_options"
                                                :placeholder="
                                                    translate('Choose')
                                                "
                                                :searchable="true"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.direction,
                                                }"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.direction"
                                            >
                                                {{ formErrors.direction[0] }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="film_web_page">{{
                                                translate("Web page")
                                            }}
                                         ({{ translate('optional') }})    
                                        </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="film_web_page"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.film_web_page,
                                                }"
                                                v-model="form.film_web_page"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.film_web_page"
                                            >
                                                {{
                                                    formErrors.film_web_page[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="film_facebook_page">{{
                                                translate("Facebook page")
                                            }}
                                             ({{ translate('optional') }})    
                                        </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="film_facebook_page"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.film_facebook_page,
                                                }"
                                                v-model="
                                                    form.film_facebook_page
                                                "
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="
                                                    formErrors.film_facebook_page
                                                "
                                            >
                                                {{
                                                    formErrors
                                                        .film_facebook_page[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="photography">{{
                                                translate("Photography")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="photography "
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.photography,
                                                }"
                                                v-model="form.photography"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.photography"
                                            >
                                                {{ formErrors.photography[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="sound">{{
                                                translate("Sound")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.sound,
                                                }"
                                                v-model="form.sound"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.sound"
                                            >
                                                {{ formErrors.sound[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="music">{{
                                                translate("Music")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.music,
                                                }"
                                                v-model="form.music"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.music"
                                            >
                                                {{ formErrors.music[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Languages")
                                            }}</label>
                                            <!-- <Multiselect v-model="form.languages" :options="Languages_options"
                                                :placeholder="translate('Choose')" :searchable="true" :class="{
                                                    'invalid-bg':
                                                        formErrors.languages,
                                                }" /> -->
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.languages,
                                                }"
                                                v-model="form.languages"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.languages"
                                            >
                                                {{ formErrors.languages[0] }}
                                            </div>
                                        </div>

                                        <div
                                            class="col-12 col-md-6"
                                            v-if="form.languages == 'Others'"
                                        >
                                            <label for="specify_language">{{
                                                translate("Specify Language")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.specify_language,
                                                }"
                                                v-model="form.specify_language"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="
                                                    formErrors.specify_language
                                                "
                                            >
                                                {{
                                                    formErrors
                                                        .specify_language[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Subtitles")
                                            }}</label>
                                            <!-- <Multiselect v-model="form.subtitles" :options="Subtitles_options"
                                                :placeholder="translate('Choose')" :searchable="true" mode="tags"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.subtitles,
                                                }" /> -->

                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.subtitles,
                                                }"
                                                v-model="form.subtitles"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.subtitles"
                                            >
                                                {{ formErrors.subtitles[0] }}
                                            </div>
                                        </div>

                                        <div
                                            class="col-12 col-md-6"
                                            v-if="form.subtitles == 'Others'"
                                        >
                                            <label for="specify_subtitle">{{
                                                translate("Specify Subtitle")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.specify_subtitle,
                                                }"
                                                v-model="form.specify_subtitle"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="
                                                    formErrors.specify_subtitle
                                                "
                                            >
                                                {{
                                                    formErrors
                                                        .specify_subtitle[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Synopsis")
                                            }}</label>
                                            <textarea
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.synopsis,
                                                }"
                                                v-model="form.synopsis"
                                                rows="3"
                                            ></textarea>

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.synopsis"
                                            >
                                                {{ formErrors.synopsis[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Notes")
                                            }}</label>
                                            <textarea
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.notes,
                                                }"
                                                v-model="form.notes"
                                                rows="3"
                                            ></textarea>

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.notes"
                                            >
                                                {{ formErrors.notes[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div style="overflow: auto; margin: 10px">
                                        <div style="float: right">
                                            <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> -->
                                            <button
                                                class="btn btn-success"
                                                @click="goToStep(1, 1)"
                                            >
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="activePhase == 2">
                            <!-- mode group started -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Images") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-4">
                                            <div class="c-files">
                                                <label
                                                    class="col-6 col-form-label"
                                                    >{{
                                                        translate("Screen Shot")
                                                    }}</label
                                                >
                                                <input
                                                    class="form-control c-file-padding"
                                                    :class="{
                                                        'invalid-bg':
                                                            formErrors.screen_shot,
                                                    }"
                                                    type="file"
                                                    @input="
                                                        form.screen_shot =
                                                            $event.target.files[0]
                                                    "
                                                    id="screen_shot"
                                                />
                                            </div>
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.screen_shot"
                                            >
                                                {{ formErrors.screen_shot[0] }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="c-files">
                                                <label
                                                    class="col-6 col-form-label"
                                                    >{{
                                                        translate("Poster")
                                                    }}
                                                     ({{ translate('optional') }}) 
                                                    </label
                                                >
                                                <input
                                                    class="form-control c-file-padding"
                                                    :class="{
                                                        'invalid-bg':
                                                            formErrors.poster,
                                                    }"
                                                    type="file"
                                                    @input="
                                                        form.poster =
                                                            $event.target.files[0]
                                                    "
                                                    id="poster"
                                                />
                                            </div>
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.poster"
                                            >
                                                {{ formErrors.poster[0] }}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="c-files">
                                                <label
                                                    class="col-12 col-form-label"
                                                >
                                                    {{
                                                        translate(
                                                            "Choose photo for gallery"
                                                        )
                                                    }}
                                                     ({{ translate('optional') }}) 
                                                    </label
                                                >
                                                <input
                                                    class="form-control c-file-padding"
                                                    :class="{
                                                        'invalid-bg':
                                                            formErrors.photo_gallery,
                                                    }"
                                                    type="file"
                                                    @input="
                                                        form.photo_gallery =
                                                            $event.target.files
                                                    "
                                                    ref="file"
                                                    multiple
                                                />
                                            </div>
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.photo_gallery"
                                            >
                                                {{
                                                    formErrors.photo_gallery[0]
                                                }}
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: 10px"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(2)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(2)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mode group ended -->
                        </div>

                        <!-- author group starts -->
                        <div v-if="activePhase == 3">
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Authors") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Screen play")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.screen_play,
                                                }"
                                                v-model="form.screen_play"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.screen_play"
                                            >
                                                {{ formErrors.screen_play[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Texts")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.texts,
                                                }"
                                                v-model="form.texts"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.texts"
                                            >
                                                {{ formErrors.texts[0] }}
                                            </div>
                                        </div>
                                        <div class="card c-form-card">
                                            <div
                                                class="card-header c-form-card-header"
                                            >
                                                {{ translate("Geographies") }}
                                            </div>
                                            <div class="card-body pt-4">
                                                <div class="row g-3">
                                                    <div class="row g-3">
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label>{{
                                                                translate(
                                                                    "Countries of Origin"
                                                                )
                                                            }}</label>
                                                            <Multiselect
                                                                v-model="
                                                                    form.geographies
                                                                "
                                                                :placeholder="
                                                                    translate(
                                                                        'Choose'
                                                                    )
                                                                "
                                                                :options="
                                                                    Geographies_options
                                                                "
                                                                :searchable="
                                                                    true
                                                                "
                                                                mode="tags"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.geographies,
                                                                }"
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.geographies
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .geographies[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label>{{
                                                                translate(
                                                                    "Narrated Geographies"
                                                                )
                                                            }}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.narrated_geographies,
                                                                }"
                                                                v-model="
                                                                    form.narrated_geographies
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.narrated_geographies
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .narrated_geographies[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3">
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label>{{
                                                                translate(
                                                                    "Keywords"
                                                                )
                                                            }}</label>
                                                            <Multiselect
                                                                v-model="
                                                                    form.keywords
                                                                "
                                                                mode="tags"
                                                                :close-on-select="
                                                                    false
                                                                "
                                                                :searchable="
                                                                    true
                                                                "
                                                                :options="
                                                                    keywords_options
                                                                "
                                                                :placeholder="
                                                                    translate(
                                                                        'Choose'
                                                                    )
                                                                "
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.keywords,
                                                                }"
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.keywords
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .keywords[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: 10px"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(3)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(3, 3)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- authors group ended -->

                        <!-- Geographies  group card start -->
                        <!-- <div v-if="activePhase == 3">
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Geographies") }}
                                </div>
                                <div class="card-body pt-4">
                                    
                                </div>

                            </div>
                        </div> -->
                        <!-- Geographies  group card close -->

                        <!-- keywords  group card close -->
                        <!-- <div v-if="activePhase == 4">
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Keywords") }}
                                </div>
                                <div class="card-body pt-4">
                                    
                                </div>
                            </div>
                        </div> -->
                        <!-- keywords  group card close -->

                        <div v-if="activePhase == 4">
                            <!-- mode group started -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Mode") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Animation"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Animation"
                                                    >{{
                                                        translate("Animation")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Biography"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Biography"
                                                    >{{
                                                        translate("Biography")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Community-based"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Community-based"
                                                    >{{
                                                        translate(
                                                            "Community-based"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Docufiction"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Docufiction"
                                                    >{{
                                                        translate("Docufiction")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Educational"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Educational"
                                                    >{{
                                                        translate("Educational")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Mockumentary"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Mockumentary"
                                                    >{{
                                                        translate(
                                                            "Mockumentary"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Musical"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Musical"
                                                    >{{
                                                        translate("Musical")
                                                    }}</label
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Ethnographic"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Ethnographic"
                                                    >{{
                                                        translate(
                                                            "Ethnographic"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Experimental"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Experimental"
                                                    >{{
                                                        translate(
                                                            "Experimental"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Found footage"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Found footage"
                                                    >{{
                                                        translate(
                                                            "Found footage"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Institutional"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Institutional"
                                                    >{{
                                                        translate(
                                                            "Institutional"
                                                        )
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="History"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="History"
                                                    >{{
                                                        translate("History")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Interactive"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Interactive"
                                                    >{{
                                                        translate("Interactive")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Nature"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Nature"
                                                    >{{
                                                        translate("Nature")
                                                    }}</label
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Newscast"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Newscast"
                                                    >{{
                                                        translate("Newscast")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Poetic"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Poetic"
                                                    >{{
                                                        translate("Poetic")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Testimonial"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Testimonial"
                                                    >{{
                                                        translate("Testimonial")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Travel"
                                                />
                                                <label
                                                    class="director-check-label"
                                                    for="Travel"
                                                    >{{
                                                        translate("Travel")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Videoart"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Videoart"
                                                    >{{
                                                        translate("Videoart")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Video Essay"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Video Essay"
                                                    >{{
                                                        translate("Video Essay")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="form-check col-12 col-md-6"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    v-model="form.modes"
                                                    value="Others"
                                                    @change="
                                                        enableModeSpecify(
                                                            $event
                                                        )
                                                    "
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="Others"
                                                    >{{
                                                        translate("Others")
                                                    }}</label
                                                >
                                            </div>
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.modes"
                                            >
                                                {{ formErrors.modes[0] }}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div
                                                class="col-12 col-md-6"
                                                v-if="modeSpecifyEnable == 1"
                                            >
                                                <label for="mode_specify">{{
                                                    translate("Mode specify")
                                                }}</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="mode_specify"
                                                    :class="{
                                                        'invalid-bg':
                                                            formErrors.mode_specify,
                                                    }"
                                                    v-model="form.mode_specify"
                                                />

                                                <div
                                                    class="invalid-feedback animated fadeIn"
                                                    v-if="
                                                        formErrors.mode_specify
                                                    "
                                                >
                                                    {{
                                                        formErrors
                                                            .mode_specify[0]
                                                    }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: 10px"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(4)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(4)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mode group ended -->
                        </div>

                        <div v-if="activePhase == 5">
                            <!-- Technology  group card start -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("Technology") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Formats")
                                            }}</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.format,
                                                }"
                                                v-model="form.format"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.format"
                                            >
                                                {{ formErrors.format[0] }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label>{{
                                                translate("Color")
                                            }} ({{ translate('optional') }}) </label>
                                            <Multiselect
                                                v-model="form.color"
                                                :placeholder="
                                                    translate('Choose')
                                                "
                                                :options="Color_options"
                                                :searchable="true"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.color,
                                                }"
                                            />
                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.color"
                                            >
                                                {{ formErrors.color[0] }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card c-form-card mt-3">
                                        <div
                                            class="card-header c-form-card-header"
                                        >
                                            {{ translate("Production") }}
                                        </div>
                                        <div class="card-body pt-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div
                                                        class="row g-3"
                                                        v-if="
                                                            form.direction ==
                                                            'Individual'
                                                        "
                                                    >
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="production_name"
                                                                >{{
                                                                    translate(
                                                                        "Production name"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="production_name"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.production_name,
                                                                }"
                                                                v-model="
                                                                    form.production_name
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.production_name
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .production_name[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="production_address"
                                                                >{{
                                                                    translate(
                                                                        "Production address"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="production_address"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.production_address,
                                                                }"
                                                                v-model="
                                                                    form.production_address
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.production_address
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .production_address[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="production_email"
                                                                >{{
                                                                    translate(
                                                                        "Production email"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                id="production_email"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.production_email,
                                                                }"
                                                                v-model="
                                                                    form.production_email
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.production_email
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .production_email[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="production_webpage"
                                                                >{{
                                                                    translate(
                                                                        "Production web page"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="production_webpage"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.production_webpage,
                                                                }"
                                                                v-model="
                                                                    form.production_webpage
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.production_webpage
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .production_webpage[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="production_additional_contact_info"
                                                                >{{
                                                                    translate(
                                                                        "Production additional contact info"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="production_additional_contact_info"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.production_additional_contact_info,
                                                                }"
                                                                v-model="
                                                                    form.production_additional_contact_info
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.production_additional_contact_info
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .production_additional_contact_info[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3" v-else>
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="organization_name"
                                                                >{{
                                                                    translate(
                                                                        "Organization name"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="organization_name"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.organization_name,
                                                                }"
                                                                v-model="
                                                                    form.organization_name
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.organization_name
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .organization_name[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="organization_contact"
                                                                >{{
                                                                    translate(
                                                                        "Organization contact"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="organization_contact"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.organization_contact,
                                                                }"
                                                                v-model="
                                                                    form.organization_contact
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.organization_contact
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .organization_contact[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="organization_webpage"
                                                                >{{
                                                                    translate(
                                                                        "Organization web page"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="organization_webpage"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.organization_webpage,
                                                                }"
                                                                v-model="
                                                                    form.organization_webpage
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.organization_webpage
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .organization_webpage[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="organization_email"
                                                                >{{
                                                                    translate(
                                                                        "Organization email"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                id="organization_email"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.organization_email,
                                                                }"
                                                                v-model="
                                                                    form.organization_email
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.organization_email
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .organization_email[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="organization_additional_contact_info"
                                                                >{{
                                                                    translate(
                                                                        "Organization additional contact info"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="organization_additional_contact_info"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.organization_additional_contact_info,
                                                                }"
                                                                v-model="
                                                                    form.organization_additional_contact_info
                                                                "
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.organization_additional_contact_info
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .organization_additional_contact_info[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card c-form-card mt-3">
                                        <div
                                            class="card-header c-form-card-header"
                                        >
                                            {{
                                                translate("Access distribution")
                                            }}
                                        </div>
                                        <div class="card-body pt-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="row g-3">
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="access_distrubution_name"
                                                                >{{
                                                                    translate(
                                                                        "Distribution name"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="access_distrubution_name"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.access_distrubution_name,
                                                                }"
                                                                v-model="
                                                                    form.access_distrubution_name
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.access_distrubution_name
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .access_distrubution_name[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="access_distrubution_address"
                                                                >{{
                                                                    translate(
                                                                        "Address"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="access_distrubution_address"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.access_distrubution_address,
                                                                }"
                                                                v-model="
                                                                    form.access_distrubution_address
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.access_distrubution_address
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .access_distrubution_address[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="access_distrubution_email"
                                                                >{{
                                                                    translate(
                                                                        "Email"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="email"
                                                                class="form-control"
                                                                id="access_distrubution_email"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.access_distrubution_email,
                                                                }"
                                                                v-model="
                                                                    form.access_distrubution_email
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.access_distrubution_email
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .access_distrubution_email[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="access_distrubution_webpage"
                                                                >{{
                                                                    translate(
                                                                        "Web page"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="access_distrubution_webpage"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.access_distrubution_webpage,
                                                                }"
                                                                v-model="
                                                                    form.access_distrubution_webpage
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.access_distrubution_webpage
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .access_distrubution_webpage[0]
                                                                }}
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label
                                                                for="access_distrubution_additional_contact_info"
                                                                >{{
                                                                    translate(
                                                                        "Additional contact info"
                                                                    )
                                                                }} ({{ translate('optional') }}) </label
                                                            >
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="access_distrubution_additional_contact_info"
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.access_distrubution_additional_contact_info,
                                                                }"
                                                                v-model="
                                                                    form.access_distrubution_additional_contact_info
                                                                "
                                                            />

                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.access_distrubution_additional_contact_info
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .access_distrubution_additional_contact_info[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card c-form-card">
                                        <div
                                            class="card-header c-form-card-header"
                                        >
                                            {{ translate("Classification") }}
                                        </div>
                                        <div class="card-body pt-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div
                                                            class="col-12 col-md-6"
                                                        >
                                                            <label>{{
                                                                translate(
                                                                    "Classification"
                                                                )
                                                            }} ({{ translate('optional') }}) </label>
                                                            <Multiselect
                                                                v-model="
                                                                    form.classification
                                                                "
                                                                :options="
                                                                    classification_options
                                                                "
                                                                :placeholder="
                                                                    translate(
                                                                        'Choose'
                                                                    )
                                                                "
                                                                mode="tags"
                                                                :searchable="
                                                                    true
                                                                "
                                                                :class="{
                                                                    'invalid-bg':
                                                                        formErrors.classification,
                                                                }"
                                                            />
                                                            <div
                                                                class="invalid-feedback animated fadeIn"
                                                                v-if="
                                                                    formErrors.classification
                                                                "
                                                            >
                                                                {{
                                                                    formErrors
                                                                        .classification[0]
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="overflow: auto; margin: 10px">
                                        <div style="float: right">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="nextPrev(5)"
                                            >
                                                Previous
                                            </button>
                                            <button
                                                v-if="formStatus == 1"
                                                type="submit"
                                                class="btn btn-success ms-1"
                                                @click="goToStep(5)"
                                            >
                                                {{ translate("Submit") }}
                                            </button>

                                            <button
                                                class="btn btn-success ms-1"
                                                type="button"
                                                disabled
                                                v-else
                                            >
                                                {{ translate("Submit") }}
                                                <span
                                                    class="spinner-border spinner-border-sm"
                                                    role="status"
                                                    aria-hidden="true"
                                                ></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Technology  group card close -->
                        </div>

                        <!-- Circles which indicates the steps of the form: -->
                        <div
                            style="text-align: center; margin-top: 40px"
                            v-if="activePhase != 11"
                        >
                            <span
                                v-if="
                                    activePhase == 1 ||
                                    activePhase == 2 ||
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="
                                    activePhase == 2 ||
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="activePhase == 4 || activePhase == 5"
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="activePhase == 5"
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import Master from "@/Pages/Layouts/Master";
import { Head } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import Slider from "@vueform/slider";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    layout: Master,
    components: {
        Head,
        Multiselect,
        Datepicker,
        Slider,
    },
    props: [
        "participant_id",
        "seo",
        "applied_by_name",
        "email",
        "eventId",
        "eventTitle",
        "eventStartDate",
        "eventEndDate",
        "role",
        "message",
    ],
    created() {
       
        // this.form.name = this.applied_by_name;
        // this.form.last_name = this.applied_by_name;
        // this.form.email = this.email;
        // this.form.eventId = this.eventId;
        this.form.eventTitle = this.eventTitle;
        // this.form.eventStartDate = this.eventStartDate;
        // this.form.eventEndDate = this.eventEndDate;
        this.form.role = this.role;

        this.fetchCountries();
        this.fetchDropdowns();
    },

    data() {
        return {
            TitleInTranslateList: [
                {
                    multi_language: "",
                    title_in_translate: "",
                },
            ],
            form: {
                original_title: "",
                director: this.role,
                director_sex: "",
                // title_in_translation: "",

                poster: "",
                screen_shot: "",
                photo_gallery: "",

                // length: "",
                length: [0],
                year_of_completion: "",
                year_of_release: "",
                trailer_link: "",
                film_link: "",
                endpoint: [],
                contact: "",
                film_web_page: "",
                film_facebook_page: "",
                screen_play: [],
                texts: [],
                format: "",
                color: "",

                production_name: "",
                production_address: "",
                production_email: "",
                production_webpage: "",
                production_additional_contact_info: "",

                access_distrubution_name: "",
                access_distrubution_address: "",
                access_distrubution_email: "",
                access_distrubution_webpage: "",
                access_distrubution_additional_contact_info: "",

                photography: "",
                sound: "",
                music: "",
                languages: "",
                specify_language: "",
                // subtitles: [],
                subtitles: "",
                geographies: [],
                narrated_geographies: [],
                keywords: [],
                direction: "",

                organization_name: "",
                organization_director_name: "",

                organization_contact: "",
                organization_email: "",
                organization_webpage: "",
                organization_additional_contact_info: "",

                synopsis: "",
                contents: [],
                classification: [],
                modes: [],
                mode_specify: "",
                notes: "",
                participant_id: "",
                eventId: "",
            },

            filmType_options: [],
            Endpoint_options: [],

            Color_options: [],

            Geographies_options: [],
            Direction_options: ["Individual", "Organization", "Community"],
            Gender_options: [],

            classification_options: [],

            keywords_options: [],

            formErrors: [],
            formStatus: 1,
            modeSpecifyEnable: 0,
            formErrors: [],
            formStatus: 1,
            first_step: "",
            activePhase: 1,
        };
    },
    methods: {
        fetchCountries() {
            axios
                .get(route("api.countries.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((res) => {
                    this.Geographies_options = res.data;
                    console.log(res.data);
                });
        },
        fetchDropdowns() {
            axios
                .get(route("api.films.dropdowns.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((res) => {
                    this.filmType_options =
                        res.data.dropdown_options_list.film_type;
                    this.Endpoint_options =
                        res.data.dropdown_options_list.exhibition_channel;
                    this.classification_options =
                        res.data.dropdown_options_list.classification_options;
                    this.Color_options =
                        res.data.dropdown_options_list.color_options;
                    this.keywords_options =
                        res.data.dropdown_options_list.keywords_options;
                    this.Gender_options =
                        res.data.dropdown_options_list.gender_options;
                });
        },
        addList() {
            this.TitleInTranslateList.push({
                multi_language: "",
                title_in_translate: "",
            });
        },
        removeList(index, list) {
            var idx = this.TitleInTranslateList.indexOf(list);

            if (idx > -1) {
                this.TitleInTranslateList.splice(idx, 1);
            }
        },

        goToStep(step, po2) {
            // this.formStatus = 0;
            let formData = new FormData();

            for (const i of Object.keys(this.form.photo_gallery)) {
                formData.append("photo_gallery[]", this.form.photo_gallery[i]);
            }
            formData.append("poster", this.form.poster);
            formData.append("screen_shot", this.form.screen_shot);

            if (this.form.type == null) {
                formData.append("type", "");
            } else {
                formData.append("type", this.form.type);
            }
            formData.append("original_title", this.form.original_title);
            // formData.append("title_in_translation", this.form.title_in_translation);
            if (this.form.director == null) {
                formData.append("director", "");
            } else {
                formData.append("director", this.form.director);
            }
            if (this.form.director_sex == null) {
                formData.append("director_sex", "");
            } else {
                formData.append("director_sex", this.form.director_sex);
            }
            let multi_title_list = this.TitleInTranslateList;
            formData.append(
                "multi_title_list",
                JSON.stringify(multi_title_list)
            );

            if (this.form.length == null) {
                formData.append("length", "");
            } else {
                formData.append("length", this.form.length);
            }
            formData.append("year_of_completion", this.form.year_of_completion);
            formData.append("year_of_release", this.form.year_of_release);
            formData.append("trailer_link", this.form.trailer_link);
            formData.append("film_link", this.form.film_link);

            if (this.form.endpoint == null) {
                formData.append("endpoint", "");
            } else {
                formData.append("endpoint", this.form.endpoint);
            }

            formData.append("contact", this.form.contact);
            formData.append("film_web_page", this.form.film_web_page);
            formData.append("film_facebook_page", this.form.film_facebook_page);
            formData.append("screen_play", this.form.screen_play);
            formData.append("texts", this.form.texts);
            formData.append("modes", this.form.modes);
            formData.append("mode_specify", this.form.mode_specify);
            formData.append("format", this.form.format);
            formData.append("color", this.form.color);

            formData.append("production_name", this.form.production_name);
            formData.append("production_address", this.form.production_address);
            formData.append("production_email", this.form.production_email);
            formData.append("production_webpage", this.form.production_webpage);
            formData.append(
                "production_additional_contact_info",
                this.form.production_additional_contact_info
            );

            formData.append(
                "access_distrubution_name",
                this.form.access_distrubution_name
            );
            formData.append(
                "access_distrubution_address",
                this.form.access_distrubution_address
            );
            formData.append(
                "access_distrubution_email",
                this.form.access_distrubution_email
            );
            formData.append(
                "access_distrubution_webpage",
                this.form.access_distrubution_webpage
            );
            formData.append(
                "access_distrubution_additional_contact_info",
                this.form.access_distrubution_additional_contact_info
            );

            formData.append("photography", this.form.photography);
            formData.append("sound", this.form.sound);
            formData.append("music", this.form.music);
            formData.append("languages", this.form.languages);
            formData.append("specify_language", this.form.specify_language);

            if (this.form.subtitles == null) {
                formData.append("subtitles", "");
            } else {
                formData.append("subtitles", this.form.subtitles);
            }
            if (this.form.geographies == null) {
                formData.append("geographies", "");
            } else {
                formData.append("geographies", this.form.geographies);
            }
            if (this.form.narrated_geographies == null) {
                formData.append("narrated_geographies", "");
            } else {
                formData.append(
                    "narrated_geographies",
                    this.form.narrated_geographies
                );
            }
            if (this.form.keywords == null) {
                formData.append("keywords", "");
            } else {
                formData.append("keywords", this.form.keywords);
            }
            formData.append("direction", this.form.direction);

            formData.append("organization_name", this.form.organization_name);
            formData.append(
                "organization_director_name",
                this.form.organization_director_name
            );

            formData.append(
                "organization_contact",
                this.form.organization_contact
            );
            formData.append("organization_email", this.form.organization_email);
            formData.append(
                "organization_webpage",
                this.form.organization_webpage
            );
            formData.append(
                "organization_additional_contact_info",
                this.form.organization_additional_contact_info
            );

            formData.append("synopsis", this.form.synopsis);
            formData.append("notes", this.form.notes);
            formData.append("email", this.email);
            formData.append("participant_id", this.participant_id);
            formData.append("event_id", this.eventId);
            formData.append("eventTitle", this.eventTitle);
            formData.append("role", this.role);

            if (this.form.contents == null) {
                formData.append("contents", "");
            } else {
                formData.append("contents", this.form.contents);
            }
            if (this.form.classification == null) {
                formData.append("classification", "");
            } else {
                formData.append("classification", this.form.classification);
            }

            if (step == 1) {
                axios
                    .post(route("api.front.film.store"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then((data) => {
                        // toastr.success(this.translate("General info submitted successfully."));
                        this.formErrors = false;
                        step++;
                        this.activePhase = step;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            } else if (step == 2) {
                axios
                    .post(route("api.front.film.store2"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then((data) => {
                        // toastr.success(this.translate("Author group submitted successfully."));
                        this.formErrors = false;
                        step++;
                        this.activePhase = step;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            } else if (step == 3) {
                axios
                    .post(route("api.front.film.store3"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then((data) => {
                        // toastr.success(this.translate("Mode submitted successfully."));
                        this.formErrors = false;
                        step++;
                        this.activePhase = step;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            } else if (step == 4) {
                axios
                    .post(route("api.front.film.store4"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then((data) => {
                        // toastr.success(this.translate("Mode submitted successfully."));
                        this.formErrors = false;
                        step++;
                        this.activePhase = step;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            } else if (step == 5) {
                this.formStatus = 0;
                axios
                    .post(route("api.front.film.store5"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then(() => {
                        toastr.success(
                            this.translate("You applied successfully.")
                        );
                        this.$inertia.get(route("success.message"));

                        // step = 1;
                        // this.activePhase = step;
                        // this.formStatus = 1;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            }

            this.activePhase = step;
        },
        enableModeSpecify: function (e) {
            if (this.modeSpecifyEnable == 0) {
                this.modeSpecifyEnable = 1;
            } else {
                this.modeSpecifyEnable = 0;
            }
        },
        nextPrev(step) {
            this.activePhase = step - 1;
        },
        getYearRange(){
            let last_6_year = moment().subtract(7, 'y').format('YYYY')
            let next_year = moment().add(1, 'y').format('YYYY');
            return [last_6_year, next_year];
        }
    },
};
</script>
<style src="@vueform/slider/themes/default.css"></style>
<style>
#regForm {
    background-color: #ffffff;
    margin: 80px auto;
    width: 70%;
    min-width: 300px;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}

h1 {
    text-align: center;
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
    background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
    display: none;
}

#hero {
    height: 0vh !important;
}

#prevBtn {
    background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
}

.bg-color {
    background-color: #8b2d88;
}
.c-bg-theme-black {
    background: black !important;
}
</style>
