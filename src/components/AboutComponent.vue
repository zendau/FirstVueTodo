<template>
  <div class="hello">
    <input type="text" v-model="message">
    <p>{{msg}} and {{test}}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "test",
    }
  },
  name: 'HelloWorld',
  props: {
    msg: String,
    test: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
p {
  font-size: 50px;
  transition: .5s ease;
  &:hover {
    color: red;
  }
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
