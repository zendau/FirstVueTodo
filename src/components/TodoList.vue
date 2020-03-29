<template>
    <div class="list">
        <ul  v-if="todos.length">
            <TodoItem 
            v-for="(item,i) in todos" :key="item.id"
            v-bind:todo="item"
            v-bind:index="i"
            v-bind:bgColor="bgColor"
            v-bind:nameTodo="nameTodo"
            v-on:remove-todo="remove"
            />
        </ul>
        <p v-else>No todo</p>
    </div>
</template>


<script>

import TodoItem from '@/components/TodoItem.vue'

export default {
    data(){
        return {
        }
    },
    methods: {
        remove(id){
            this.$emit("remove-todo", id);
        }
    },
    props: ['todos', 'bgColor', "nameTodo"],
    components: {
        TodoItem
    }
}
</script>

<style lang="scss">
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
</style>