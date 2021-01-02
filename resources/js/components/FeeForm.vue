<template>
  <div>
    <div class="form-group row">
      <label for="harga">Harga</label>
      <div class="col-md">
        <input
          type="text"
          class="form-control"
          name="harga"
          autofocus
          v-model="harga"
          :disabled="uneditable"
        />
      </div>
    </div>

    <div class="form-group row">
      <small for="cut">Menta 10%</small>
      <div class="col-md">
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="tenPercent"
          disabled
        />
      </div>
    </div>

    <div class="form-group row">
      <div for="fee">Total</div>
      <div class="col-md">
        <input type="text" class="form-control" v-model="total" readonly />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    init: {
      type: Number,
      default: 0,
    },
    uneditable: {
      type: Boolean,
      default: false,
    },
  },
  data: function () {
    return {
      harga: 0,
      tenPercent: 0,
      total: 0,
    };
  },
  mounted: function () {
    this.harga = this.init;
  },
  watch: {
    harga: function (val) {
      this.tenPercent = Math.floor(val * 0.1);
      this.total = Math.floor(val * 1.1);
    },
  },
};
</script>
