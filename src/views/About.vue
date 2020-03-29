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


export default {
  name: 'About',
  data(){
    return {
      bgColor: "success",
      nameTodo: "Вещи",
      todos: [
        {id: "1", title: "Купить кружку", status: false},
        {id: "2", title: "Купить доску", status: false},
        {id: "3", title: "Купить тарелку", status: false},
      ]
    }
  },
  mounted() {
    console.log("ok")
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
