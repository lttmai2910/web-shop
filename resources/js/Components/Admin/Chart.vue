<template>
  <div>
    <canvas ref="chartCanvas"></canvas>
  </div>
</template>

<script>
import { Chart, registerables } from 'chart.js';
import { ref, watch, onMounted } from 'vue';

Chart.register(...registerables);

const formatMoney = (value) => {
  return value * 1000; // Chuyển giá trị lên đơn vị nghìn (k)
}

export default {
  props: {
    monthlyStatistic: {
      type: Array,
      required: true
    }
  },
  mounted() {
    this.renderChart();
  },
  methods: {
    renderChart() {
      const ctx = this.$refs.chartCanvas.getContext('2d');

      // Extracting month labels and revenue values from props
      const months = this.monthlyStatistic.map(item => `Tháng ${item.month}`);
      const revenues = this.monthlyStatistic.map(item => formatMoney(item.total_revenue)); // Sửa thành total_revenue

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: months,
          datasets: [{
            label: 'Tổng tiền (VNĐ)',
            data: revenues,
            backgroundColor: 'rgba(46, 139, 87, 0.6)',
            borderColor: 'rgba(34, 139, 34, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Tổng tiền (VNĐ)'
              },
              ticks: {
                callback: function(value) {
                  return new Intl.NumberFormat('en-US').format(value); // Định dạng số có dấu phẩy ngăn cách hàng nghìn
                }
              }
            }
          }
        }
      });
    }
  },
  watch: {
    monthlyStatistic() {
      this.renderChart(); // Re-render chart on prop change
    }
  }
};

</script>

<style scoped>
/* Add scoped styles here */
</style>
