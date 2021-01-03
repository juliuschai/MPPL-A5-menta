<template>
  <div id="therapistList" v-cloak>
    <input v-model="keyword" type="search">
    <button @click="search">Search</button>

    <div :key="result.id" v-for="result in results" class="result">
      <img :src="result.profile_pic_file" width="100px" height="100px"><br>
      <b>Name:</b> {{ result.name }}<br>
      <b>Bidang:</b> {{ result.expertise }}<br>
      <b>Jam Buka:</b> {{ toTimeString(result.opening_hours) }}<br>
      <b>Jam Tutup:</b> {{ toTimeString(result.closing_hours) }}<br>
      <br clear="left">
      <a :href="'https://www.menta.com/view/'+result.id">
        <button class="btn btn-warning">View</button>
      </a>
    </div>

    <button v-if="!noResults && !noMoreResults" type="button" @click="more">
      Temukan lagi
    </button>

    <div v-if="noResults">Hasil search kosong.</div>
    <div v-if="noMoreResults">Semua tertampilkan.</div>

    <div v-if="searching">
      <i>Searching...</i>
    </div>
  </div>
</template>

<script>
export default {
  props: ["searchUrl"],
  data: function () {
    return {
      page: 1,
      seed: "",
      keyword: "",
      results: [],
      noResults: false,
      noMoreResults: false,
      searching: false,
    };
  },
  created: function () {
    this.search();
  },
  methods: {
    search: function () {
      this.searching = true;
      this.noMoreResults = false;

      let url = this.searchUrl;
      let urlParams = new URLSearchParams();

      if (this.keyword) urlParams.append("keyword", this.keyword);
      url += "?" + urlParams.toString();

      fetch(url)
        .then((res) => res.json())
        .then((res) => {
          this.searching = false;
          this.results = res.results;
          this.noResults = res.results.length === 0;
          if (res.seed) this.sed = res.seed;
        });
    },
    more: function () {
      this.searching = true;

      let url = this.searchUrl;
      let urlParams = new URLSearchParams();

      if (this.keyword) urlParams.append("keyword", this.keyword);
      if (this.seed) urlParams.append("seed", this.seed);
      if (this.page) urlParams.append("page", this.page);
      url += "?" + urlParams.toString();

      fetch(url)
        .then((res) => res.json())
        .then((res) => {
          this.searching = false;
          this.results.concat(res.results);
          this.noMoreResults = res.results.length === 0;
        });
      this.page += 1;
    },
    createSearchParam: function () {
      let url = this.searchUrl;
      urlParams = new URLSearchParams();
      if (this.keyword) urlParams.append("keyword", this.keyword);
      if (this.seed) urlParams.append("seed", this.seed);
    },
    pz: function (inp) {
      return ("0" + inp).slice(-2);
    },
    toTimeString: function (timeStr) {
      let timeArr = timeStr.split(':');
      let date = new Date();
      date.setHours(timeArr[0], timeArr[1], timeArr[2]);
      return `${this.pz(date.getHours())}:${this.pz(date.getMinutes())}`;
    },
  },
};
</script>
