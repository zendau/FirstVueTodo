<template>
  <div class="home">
    <AddItem v-on:add-todo="addTodo"/>
    <TodoList v-bind:todos="todos" v-bind:nameTodo="nameTodo" v-bind:bgColor="bgColor" v-on:remove-todo="remove"/>
  </div>
</template>

<script>
// @ is an alias to /src
import TodoList from '@/components/TodoList.vue'
import AddItem from '@/components/AddItem.vue'

import axios from "axios"

export default {
  name: 'Home',
  data(){
    return {
      bgColor: "primary",
      nameTodo: "Продукты",
      info: "",
      todos: [
        {id: "1", title: "Купить молоко", status: false},
        {id: "2", title: "Купить хлеб", status: false},
        {id: "3", title: "Купить воду", status: false},
      ]
    }
  },
  mounted() {
    console.log("ok")
    axios
    .get('http://vuetest/')
      .then(response => (console.log(response.data.bpi)));
      
  },
  methods: {
    remove(id){
      console.log(id);
      this.todos = this.todos.filter(t => t.id !== id)
    },
    addTodo(text){
      if(text.trim()){
        this.todos.push({id: Date.now(), title: text, status: false})
      }
    }
  },
  components: {
    TodoList, AddItem
  }
}
</script>
