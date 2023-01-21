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

            <Link class="btn btn-success" :href="route('pie')"><i class="bi bi-plus-lg"></i>{{ translate('Pie Chart') }} </Link>

            
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->

                   <Bar
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
    <!-- End #main -->
    
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    layout: Master,

    name: 'BarChart',
    components: { Bar },
    props: {
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      
      default: 300
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },

    created() {
       
    },
    data() {
       return {
      chartData: {
        labels: ["Mathematics", "Programing", "Statistics", "Chemistry", "Biology", "Physics",
                 "C++", "PHP", "HTML", "Laravel", "React", "VueJs"
                ],
        datasets: [
          {
            backgroundColor: ["#41B883", "#E46651", "#00D8FF", "#DD1B16",'indigo','tomato','blue','purple '],
            data: [23, 56, 74, 60,66,69,23, 33, 45, 33,68,39],
          },
        ],
      },
       chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    }
    },
    methods: {
         
         
    },
};
</script>


<style>
.table td, .table th {
   vertical-align: middle;
}
</style>