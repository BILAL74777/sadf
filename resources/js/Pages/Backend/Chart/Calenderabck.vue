<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Events Calender") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Calender") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Events Calender") }}
            </li>
          </ol>
        </nav>
      </div>
     
    </div>
    <section class="section">
      <div class="card">
        <div class="card-body pt-4">
          <div class="demo-app">
            <!-- <div class="demo-app-sidebar">
              <div class="demo-app-sidebar-section">
                <h2>Instructions</h2>
                <ul>
                  <li>
                    Select dates and you will be prompted to create a new event
                  </li>
                  <li>Drag, drop, and resize events</li>
                  <li>Click an event to delete it</li>
                </ul>
              </div>
              <div class="demo-app-sidebar-section">
                <label>
                  <input
                    type="checkbox"
                    :checked="calendarOptions.weekends"
                    @change="handleWeekendsToggle"
                  />
                  toggle weekends
                </label>
              </div>
              <div class="demo-app-sidebar-section">
                <h2>All Events ({{ currentEvents.length }})</h2>
                <ul>
                  <li v-for="event in currentEvents" :key="event.id">
                    <b>{{ event.startStr }}</b>
                    <i>{{ event.title }}</i>
                  </li>
                </ul>
              </div>
            </div> -->
            <div class="demo-app-main">
              <FullCalendar
                class="demo-app-calendar"
                :options="calendarOptions"
              >
                <template v-slot:eventContent="arg">
                  <b>{{ arg.timeText }}</b>
                  <i>{{ arg.event.title }}</i>
                </template>
              </FullCalendar>
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
import { INITIAL_EVENTS, createEventId } from "./event-utils";

export default {
  layout: Master,
   created() {
        this.fetchEvents();
        // this.abc() ;
    },
  components: {
    FullCalendar, // make the <FullCalendar> tag available
  },

  data: function () {
    return {
      Events:[],
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
        initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.abc, 
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents,
        /* you can update a remote database when these fire:
        eventAdd:
        eventChange:
        eventRemove:
        */
       eventChange:this.change,
      },
      currentEvents: [],
    };
  },

  methods: {
    fetchEvents(){
            axios.get(route('api.fetch.events'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => { 
                this.Events = response.data;
                 
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
    handleWeekendsToggle() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends; // update a property
    },

    handleDateSelect(selectInfo) {
      let title = prompt("Please enter a new title for your event");
      let calendarApi = selectInfo.view.calendar;

      calendarApi.unselect(); // clear date selection

      if (title) {
          alert(createEventId());
          this.submit(title,selectInfo.startStr,selectInfo.endStr,selectInfo.allDay,createEventId());
      //  alert(calendarApi);
      // for (var element of this.Events) { // You can use `let` instead of `const` if you like
           
      
      //   calendarApi.addEvent({
      //     id: createEventId(),
      //     title: element['title'],
      //     name:"Bilal",
      //     start: element['start_date'],
      //     end: element['start_date'],
      //     allDay: element['all_day'],
      //   });
      // }   
      
      }
    },
    abc(selectInfo) {
      
      let calendarApi = selectInfo.view.calendar;
        for (var element of this.Events) { // You can use `let` instead of `const` if you like
           
      
        calendarApi.addEvent({
          id: createEventId(),
          title: element['title'],
          name:"Bilal",
          start: element['start_date'],
          end: element['start_date'],
          allDay: element['all_day'],
        });
      } 
      },
    submit(title,start_date,end_date,all_day,event_id) {
     
              this.formStatus = "No";
              let formData = new FormData();
              formData.append("title", title);
              formData.append("start_date", start_date);
              formData.append("end_date", end_date);
              formData.append("all_day", all_day);
              formData.append("event_id", event_id);
              axios
                .post(route("api.event.store"), formData, {
                  headers: {
                    Authorization: "Bearer " + this.$page.props.auth_token,
                  },
                })
                .then((data) => {
                  toastr.success("Event added successfully.");
                  // this.$inertia.get(route("calender"));
                })
                .catch((error) => {
                  toastr.error(error.response.data.message);

                  if (error.response.data.errors) {
                    // this.formStatus = "Yes";
                    this.formErrors = error.response.data.errors;
                  }
                });
            },

    change(clickInfo) {
    
      if (
        
        confirm(
          `Are you sure you want to update the event '${clickInfo.event.title}'`
        )
         
      ) 
      {
        axios.post(route("api.event.update"), clickInfo.event, {
                  headers: {
                    Authorization: "Bearer " + this.$page.props.auth_token,
                  },
                })
                .then((data) => {
                  toastr.success("Event Romoved successfully.");
                  this.$inertia.get(route("calender"));
                })
                .catch((error) => {
                  toastr.error(error.response.data.message);

                  if (error.response.data.errors) {
                    // this.formStatus = "Yes";
                    this.formErrors = error.response.data.errors;
                  }
                });
       
         
      }
    },
    handleEventClick(clickInfo) {
      if (
        
        confirm(
          `Are you sure you want to delete the event`
        )
         
      ) 
      {
        axios.post(route("api.event.remove"), clickInfo.event, {
                  headers: {
                    Authorization: "Bearer " + this.$page.props.auth_token,
                  },
                })
                .then((data) => {
                  toastr.success("Event Romoved successfully.");
                  this.$inertia.get(route("calender"));
                })
                .catch((error) => {
                  toastr.error(error.response.data.message);

                  if (error.response.data.errors) {
                    // this.formStatus = "Yes";
                    this.formErrors = error.response.data.errors;
                  }
                });
      }
    },

    handleEvents(events) {
      this.currentEvents = events;
    },
  },
};
</script>

<style lang='css'>
h2 {
  margin: 0;
  font-size: 16px;
}

ul {
  margin: 0;
  padding: 0 0 0 1.5em;
}

li {
  margin: 1.5em 0;
  padding: 0;
}

b {
  /* used for event dates/times */
  margin-right: 3px;
}

.demo-app {
  display: flex;
  min-height: 100%;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

/* .demo-app-sidebar {
  width: 300px;
  line-height: 1.5;
  background: #eaf9ff;
  border-right: 1px solid #d3e2e8;
}

.demo-app-sidebar-section {
  padding: 2em;
} */

.demo-app-main {
  flex-grow: 1;
  padding: 3em;
}

.fc {
  /* the calendar root */
  max-width: 500px;
  margin: 0 auto;
}
</style>