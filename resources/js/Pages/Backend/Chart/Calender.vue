<template>
  <main id="main" class="main">
      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>{{ translate("Events Calendar") }}</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                          <Link :href="route('dashboard')">{{
                              $page.props.website_name
                          }}</Link>
                      </li>
                      <li class="breadcrumb-item">
                          {{ translate("Calendar") }}
                      </li>
                      <li class="breadcrumb-item active">
                          {{ translate("Events Calendar") }}
                      </li>
                  </ol>
              </nav>
          </div>
      </div>
      <section class="section p-4 c-bg-white">
          <div class="demo-app-main">
              <FullCalendar
                  class="demo-app-calendar"
                  ref="FullCalendarRef"
                  :options="calendarOptions"
              >
                  <template v-slot:eventContent="arg">
                      <b>{{ arg.timeText }}</b>
                      <i>{{ arg.event.title }}</i>
                  </template>
              </FullCalendar>
              <!-- <button @click="updateEvents">Update Events</button> -->
          </div>

          <div class="modal fade" id="CreateModal" tabindex="-1">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header c-bg-theme-purple">
                          <h1 class="modal-title fs-5 text-white">
                              {{ translate("Event Create") }}
                          </h1>
                      </div>
                      <div class="modal-body">
                          <!-- Floating Labels Form -->
                          <form @submit.prevent="submit">
                              <label>{{ translate("Choose Status") }}</label>
                              <br />
                              <div class="d-inline-block me-2">
                                  {{ translate("Off") }}
                              </div>
                              <div
                                  class="form-check form-switch d-inline-block"
                              >
                                  <input
                                      class="form-check-input"
                                      type="checkbox"
                                      :class="{
                                          'invalid-bg': formErrors.status,
                                      }"
                                      v-model="form.status"
                                      checked
                                  />
                                  <label class="form-check-label">{{
                                      translate("On")
                                  }}</label>
                              </div>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.status"
                              >
                                  {{ formErrors.status[0] }}
                              </div>
                              <div class="mb-3"></div>

                              <label for="title">{{
                                  translate("Event title")
                              }}</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  id="title"
                                  :class="{
                                      'invalid-bg': formErrors.title,
                                  }"
                                  v-model="form.title"
                              />

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.title"
                              >
                                  {{ formErrors.title[0] }}
                              </div>
                              <br />
                              <label>{{
                                  translate("Event start date")
                              }}</label>
                              <Datepicker
                              autoApply
                                  :enableTimePicker="false"
                                  :class="{
                                      'invalid-bg': formErrors.start_date,
                                  }"
                                  v-model="form.start_date"
                              >
                              </Datepicker>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.start_date"
                              >
                                  {{ formErrors.start_date[0] }}
                              </div>
                              <br />

                              <label>{{ translate("Event end date") }}</label>
                              <Datepicker
                              autoApply
                                  :enableTimePicker="false"
                                  :class="{
                                      'invalid-bg': formErrors.end_date,
                                  }"
                                  v-model="form.end_date"
                              >
                              </Datepicker>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.end_date"
                              >
                                  {{ formErrors.end_date[0] }}
                              </div>
                              <br />

                              <label>{{ translate("Description") }}</label>
                              <textarea
                                  class="form-control"
                                  :class="{
                                      'invalid-bg': formErrors.description,
                                  }"
                                  v-model="form.description"
                                  rows="3"
                              ></textarea>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.description"
                              >
                                  {{ formErrors.description[0] }}
                              </div>
                              <br />

                              <label>{{ translate("Eligibility") }}</label>
                              <textarea
                                  class="form-control"
                                  :class="{
                                      'invalid-bg': formErrors.eligibility,
                                  }"
                                  v-model="form.eligibility"
                                  rows="3"
                              ></textarea>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.eligibility"
                              >
                                  {{ formErrors.eligibility[0] }}
                              </div>

                              <div class="mt-2">
                                  <button
                                      type="submit"
                                      class="btn btn-success"
                                      v-if="formStatus == 'Yes'"
                                  >
                                      {{ translate("Save") }}
                                  </button>
                                  <button
                                      class="btn btn-success"
                                      type="button"
                                      disabled
                                      v-else
                                  >
                                      {{ translate("Save") }}
                                      <span
                                          class="spinner-border spinner-border-sm"
                                          role="status"
                                          aria-hidden="true"
                                      ></span>
                                  </button>
                              </div>
                          </form>
                          <!-- End floating Labels Form -->
                      </div>
                  </div>
              </div>
          </div>

          <div class="modal fade" id="updateModel" tabindex="-1">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header c-bg-theme-purple">
                          <h1 class="modal-title fs-5 text-white">
                              {{ translate("Event Update") }}
                          </h1>
                      </div>
                      <div class="modal-body">
                          <!-- Floating Labels Form -->
                          <form @submit.prevent="update">
                              <label>{{ translate("Choose Status") }}</label>
                              <br />
                              <div class="d-inline-block me-2">
                                  {{ translate("Off") }}
                              </div>
                              <div
                                  class="form-check form-switch d-inline-block"
                              >
                                  <input
                                      class="form-check-input"
                                      type="checkbox"
                                      :class="{
                                          'invalid-bg': formErrors.status,
                                      }"
                                      v-model="UpdForm.status"
                                      checked
                                  />
                                  <label class="form-check-label">{{
                                      translate("On")
                                  }}</label>
                              </div>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.status"
                              >
                                  {{ formErrors.status[0] }}
                              </div>

                              <div class="mb-3"></div>

                              <label for="title">{{
                                  translate("Event title")
                              }}</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  id="title"
                                  :class="{
                                      'invalid-bg': formErrors.title,
                                  }"
                                  v-model="UpdForm.title"
                              />

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.title"
                              >
                                  {{ formErrors.title[0] }}
                              </div>
                              <br />

                              <label>{{
                                  translate("Event start date")
                              }}</label>
                              <Datepicker
                              autoApply
                                  :enableTimePicker="false"
                                  :class="{
                                      'invalid-bg': formErrors.start_date,
                                  }"
                                  v-model="UpdForm.start_date"
                              >
                              </Datepicker>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.start_date"
                              >
                                  {{ formErrors.start_date[0] }}
                              </div>
                              <br />
                              <label>{{ translate("Event end date") }}</label>
                              <Datepicker
                              autoApply
                                  :enableTimePicker="false"
                                  :class="{
                                      'invalid-bg': formErrors.end_date,
                                  }"
                                  v-model="UpdForm.end_date"
                              >
                              </Datepicker>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.end_date"
                              >
                                  {{ formErrors.end_date[0] }}
                              </div>

                              <br />

                              <label>{{ translate("Description") }}</label>
                              <textarea
                                  class="form-control"
                                  :class="{
                                      'invalid-bg': formErrors.description,
                                  }"
                                  v-model="UpdForm.description"
                                  rows="3"
                              ></textarea>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.description"
                              >
                                  {{ formErrors.description[0] }}
                              </div>
                              <br />
                              <label>{{ translate("Eligibility") }}</label>
                              <textarea
                                  class="form-control"
                                  :class="{
                                      'invalid-bg': formErrors.eligibility,
                                  }"
                                  v-model="UpdForm.eligibility"
                                  rows="3"
                              ></textarea>

                              <div
                                  class="invalid-feedback animated fadeIn"
                                  v-if="formErrors.eligibility"
                              >
                                  {{ formErrors.eligibility[0] }}
                              </div>

                              <div class="mt-2">
                                  <button
                                      type="submit"
                                      class="btn btn-success"
                                      v-if="formStatus == 'Yes'"
                                  >
                                      {{ translate("Update") }}
                                  </button>

                                  <button
                                      class="btn btn-success"
                                      type="button"
                                      disabled
                                      v-else
                                  >
                                      {{ translate("Update") }}
                                      <span
                                          class="spinner-border spinner-border-sm"
                                          role="status"
                                          aria-hidden="true"
                                      ></span>
                                  </button>

                                  <button
                                      class="btn btn-success ms-2"
                                      type="button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#deleteModal"
                                      title="Delete"
                                  >
                                      {{ translate("Delete") }}
                                  </button>
                              </div>
                          </form>
                          <!-- End floating Labels Form -->
                      </div>
                  </div>
              </div>
          </div>

          <button
              hidden="hidden"
              data-bs-toggle="modal"
              data-bs-target="#CreateModal"
              title="Delete"
              ref="closeModal"
          ></button>
          <button
              hidden="hidden"
              data-bs-toggle="modal"
              data-bs-target="#updateModel"
              title="Delete"
              ref="updateModel"
          ></button>

          <!-- delete Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                          <div class="block-content text-center p-4">
                              <h2>
                                  {{ translate("Are you sure?") }}
                              </h2>

                              <button
                                  type="button"
                                  class="btn btn-sm btn-success me-2"
                                  data-bs-dismiss="modal"
                                  @click="deleteThis"
                              >
                                  {{ translate("Yes, delete it!") }}
                              </button>

                              <button
                                  type="button"
                                  class="btn btn-sm btn-dark"
                                  data-bs-dismiss="modal"
                              >
                                  {{ translate("Close") }}
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </main>
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
  layout: Master,
  components: {
      FullCalendar, // make the <FullCalendar> tag available
      Datepicker,
  },

  data: function () {
      return {
          events: [],

          calendarOptions: {
              plugins: [
                  dayGridPlugin,
                  timeGridPlugin,
                  interactionPlugin,
                  // needed for dateClick
              ],
              headerToolbar: {
                  left: "prev,next today",
                  center: "title",
                  right: "dayGridMonth,timeGridWeek,timeGridDay",
              },
              initialView: "dayGridMonth",
              eventSources: [
                  {
                      events(start_date, callback) {
                          // console.log('calling logs');
                          axios
                              .get(route("api.calendar.events.fetch"))
                              .then((response) => {
                                  // console.log(response);
                                  callback(response.data);
                              });
                      },
                  },
              ],
              // events: [
              //   { title: 'event 1', date: '2022-07-13' },
              //   { title: 'event 2', date: '2022-07-20' }
              // ],
              currentEvents: [],
              // initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
              editable: true,
              selectable: true,
              selectMirror: true,
              dayMaxEvents: true,
              weekends: true,
              select: this.handleDateSelect,

              eventClick: this.handleEventClick,
              eventsSet: this.handleEvents,
              eventAdd: this.AddEvent,
              /* you can update a remote database when these fire:
      eventAdd:
      eventChange:
      eventRemove:
      */
              // eventChange: this.handleEventClick,
          },
          currentEvents: [],
          formStatus: "Yes",
          form: {
              status: "",
              title: "",
              start_date: null,
              end_date: null,
              description: "",
              eligibility: "",

              // all_day: null,
              // event_id: null,
              // DataStatus: null,
              // id: null,
          },
          UpdForm: {
              eventId: null,
              title: "",
              start_date: "",
              end_date: "",
              status: "",
              description: "",
              eligibility: "",
          },
          formErrors: [],
      };
  },

  methods: {
      AddEvent() {
          console.log("here want to add the event.");
      },
      handleWeekendsToggle() {
          this.calendarOptions.weekends = !this.calendarOptions.weekends; // update a property
      },
      handleDateSelect(selectInfo) {
          this.$refs.closeModal.click();
          let calendarApi = selectInfo.view.calendar;

          calendarApi.unselect(); // clear date selection

          this.form.start_date = selectInfo.startStr;
          this.form.end_date = selectInfo.endStr;
          // this.form.all_day = selectInfo.allDay;
          // this.form.event_id = createEventId();
          this.form.DataStatus = "Create";
      },
      // getEvent(selectInfo) {
      //     let calendarApi = selectInfo.view.calendar;
      //     for (var element of this.Events) {
      //         // You can use `let` instead of `const` if you like
      //         this.currentEvents = this.Events;

      //         calendarApi.addEvent({
      //             id: createEventId(),
      //             title: element["title"],
      //             start_date: element["start_date"],
      //             end: element["end_date"],
      //             allDay: element["all_day"],
      //             id: element["id"],
      //         });
      //     }
      // },
      passDeleteId(id) {
          this.deleteId = id;
          this.fetchEvent(id);
          this.formErrors = false;
      },
      submit(CalendarApi) {
          this.formStatus = "No";
          let formData = new FormData();
          if (this.form.status == "") {
              formData.append("status", false);
          } else {
              formData.append("status", this.form.status);
          }
          formData.append("title", this.form.title);
          // formData.append("all_day", this.addForm.all_day);
          // formData.append("event_id", this.addForm.event_id);
          // formData.append("DataStatus", this.addForm.DataStatus);
          // formData.append("id", this.addForm.id);
          // formData.append("start_date",this.form.start_date);
          // formData.append("end_date",this.form.end_date);
          if (this.form.start_date) {
              formData.append(
                  "start_date",
                  this.form.start_date.getMonth
                      ? this.form.start_date.toLocaleDateString("en-CA")
                      : this.form.start_date
                      ? this.form.start_date
                      : ""
              );
          }
          if (this.form.end_date) {
              formData.append(
                  "end_date",
                  this.form.end_date.getMonth
                      ? this.form.end_date.toLocaleDateString("en-CA")
                      : this.form.end_date
                      ? this.form.end_date
                      : ""
              );
          }
          formData.append("description", this.form.description);
          formData.append("eligibility", this.form.eligibility);

          axios
              .post(route("api.events.store"), formData, {
                  headers: {
                      Authorization: "Bearer " + this.$page.props.auth_token,
                  },
              })
              .then((data) => {
                  // here we have to refresh events
                  // successfully refetch the events
                  this.$refs.FullCalendarRef.calendar.refetchEvents();

                  toastr.success("Event added successfully.");
                  this.formStatus = "Yes";
                  this.$refs.closeModal.click();
                  this.form.title = "";
                  this.form.start_date = "";
                  this.form.end_date = "";
              })
              .catch((error) => {
                  toastr.error(error.response.data.message);

                  if (error.response.data.errors) {
                      this.formStatus = "Yes";
                      this.formErrors = error.response.data.errors;
                  }
              });
      },
      handleEventClick(clickInfo) {
          console.log(JSON.stringify(clickInfo.event.id));
          this.$refs.updateModel.click();
          this.UpdForm.title = clickInfo.event.title;
          this.UpdForm.DataStatus = "Update";
          console.log(clickInfo);
          this.UpdForm.id = clickInfo.event.id;
          this.passDeleteId(clickInfo.event.id);
      },
      handleEvents(events) {
          this.currentEvents = events;
      },
      fetchEvent(id) {
          axios
              .get(route("api.events.show", id), {
                  headers: {
                      Authorization: "Bearer " + this.$page.props.auth_token,
                  },
              })
              .then((response) => {
                  this.UpdForm.title = response.data.title;
                  this.UpdForm.start_date = response.data.start_date;
                  this.UpdForm.end_date = response.data.end_date;
                  this.UpdForm.status = response.data.status;
                  this.UpdForm.eventId = response.data.id;
                  this.UpdForm.description = response.data.description;
                  this.UpdForm.eligibility = response.data.eligibility;
              })
              .catch((error) => {
                  toastr.error(error.response.data.message);
              });
      },

      update() {
          this.formStatus = "No";
          let formData = new FormData();
          formData.append("id", this.UpdForm.eventId);
          formData.append("title", this.UpdForm.title);
          formData.append("status", this.UpdForm.status);

          if (this.UpdForm.start_date) {
              formData.append(
                  "start_date",
                  this.UpdForm.start_date.getMonth
                      ? this.UpdForm.start_date.toLocaleDateString("en-CA")
                      : this.UpdForm.start_date
                      ? this.UpdForm.start_date
                      : ""
              );
          }
          if (this.UpdForm.end_date) {
              formData.append(
                  "end_date",
                  this.UpdForm.end_date.getMonth
                      ? this.UpdForm.end_date.toLocaleDateString("en-CA")
                      : this.UpdForm.end_date
                      ? this.UpdForm.end_date
                      : ""
              );
          }
          formData.append("description", this.UpdForm.description);
          formData.append("eligibility", this.UpdForm.eligibility);

          axios
              .post(route("api.events.update"), formData, {
                  headers: {
                      Authorization: "Bearer " + this.$page.props.auth_token,
                  },
              })
              .then((data) => {
                  toastr.success(
                      this.translate("Event updated successfully.")
                  );
                  this.formStatus = "Yes";
                  this.$refs.FullCalendarRef.calendar.refetchEvents();
                  this.$refs.updateModel.click();
              })
              .catch((error) => {
                  this.formStatus = "Yes";
                  toastr.error(error.response.data.message);
                  if (error.response.data.errors) {
                      this.formErrors = error.response.data.errors;
                  }
              });
      },

      deleteThis() {
          axios
              .delete(route("api.events.delete", this.deleteId), {
                  headers: {
                      Authorization: "Bearer " + this.$page.props.auth_token,
                  },
              })
              .then(() => {
                  toastr.success("Event deleted successfully.");
                  // this.$inertia.get(route("calendar"));
                  this.$refs.FullCalendarRef.calendar.refetchEvents();
              })
              .catch((error) => {
                  toastr.error(error.response.data.message);
              });
      },
  },
};
</script>

<style scoped>
/*@import '@vueform/multiselect/themes/default.css';*/

.c-file-padding {
  padding: 1rem 0.75rem !important;
}

.invalid-feedback {
  display: block !important;
}

.invalid-bg {
  border-color: #f8d4d4 !important;
  background-color: #f8d4d4 !important;
}

/* .fc-scrollgrid  a{
  color: #8B2D88 !important;
}
.fc-scrollgrid:contains-selector(a) { color: red !important; } */
</style>
