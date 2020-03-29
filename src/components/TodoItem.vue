<template>
    <li>
        <b-card :bg-variant="bgColor" text-variant="white" :header="nameTodo" class="text-center">
            <b-card-text> 
                <b-form-checkbox class="redbtn"
                    :checked="todo.completed" 
                    v-on:change="todo.completed = !todo.completed"
                >
                </b-form-checkbox>
                <span v-bind:class="{done: todo.completed}">
                    {{index+1}} - {{todo.title}}
                </span>
            </b-card-text>
        </b-card>
        <b-button-close class="close__btn" text-variant="danger" v-on:click="$emit('remove-todo', todo.id)"></b-button-close>
    </li>
</template>


<script>

export default {
    props: ['todo', 'index', 'bgColor', "nameTodo"],

}
</script>


<style lang="scss" scoped>

    .done {
        text-decoration: line-through;
    }

    li {
        width: 500px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 50px;

        b-button {
            box-sizing: border-box;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            border: none;
            transition: .5s ease;
            &:hover {
                background-color: red;
            }
        }
        
    }

    .text-center {
        width: 100%;
    }
    
    .test label {
        display: none;
    }



</style>

<style lang="scss">

    .redbtn .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: red;
        background-color: red;
    }

    li button.close__btn {
        padding: 15px;
    }

</style>