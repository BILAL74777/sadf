<template>

  <main id="main" class="main">
          <div class="pagetitle d-flex justify-content-between">
              <div>
                  <h1>{{ translate('Charts') }}</h1>
                  <nav>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                              <Link :href="route('dashboard')">{{ $page.props.website_name }}</Link>
                          </li>
                          <li class="breadcrumb-item active">
                              {{ translate('Charts') }}
                          </li>


                          
                      </ol>
                  </nav>
              </div>

              <Link class="btn btn-success" :href="route('chart')"><i class="bi bi-plus-lg"></i>{{ translate('Bar Chart') }} </Link>

              
          </div>

          <section class="section">
                <div class="card">
                  <div class="card-body pt-4">
                      <Pie
                      :chart-options="chartOptions"
                      :chart-data="chartData"
                      :chart-id="chartId"
                      :dataset-id-key="datasetIdKey"
                      :plugins="plugins"
                      :css-classes="cssClasses"
                      :styles="styles"
                      :width="width"
                      :height="height"
                    />
                  </div>
                </div>
          </section>
  </main>
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import { Pie } from "vue-chartjs";

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
} from "chart.js";

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale);

export default {
  layout: Master,
  name: "PieChart",
  components: {
    Pie,
  },
  props: {
    chartId: {
      type: String,
      default: "pie-chart",
    },
    datasetIdKey: {
      type: String,
      default: "label",
    },
    width: {
      type: Number,
      default: 400,
    },
    height: {
      type: Number,
      default: 300,
    },
    cssClasses: {
      default: "",
      type: String,
    },
    styles: {
      type: Object,
      default: () => {},
    },
    plugins: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      chartData: {
        labels: ["Mathematics", "Programing", "Statistics", "Chemistry", "Biology", "Physics"],
        datasets: [
          {
            backgroundColor: ["#41B883", "#E46651", "#00D8FF", "#DD1B16",'indigo','tomato'],
            data: [23, 56, 74, 60,66,89],
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
};
</script>