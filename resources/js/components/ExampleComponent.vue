<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">I'm an example component.</div>
        </div>
      </div>
    </div>
    <button @click="sendRequest">Click on me</button>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    sendRequest() {},
  },
};
</script>
