<template>
    <div class="conversation">
        <h1>{{contact ? contact.name :'select a Contact'}}</h1>
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessageComposer @send="sendMessage"></MessageComposer>
    </div>
</template>

<script>
    import MessageComposer from './MessageComposer'
    import MessagesFeed from './MessagesFeed'
    export default {
        props:{
            contact:{
                type:Object,
                default:null
            },
            messages:{
                type:Array,
                default:[]
            },
        },
        methods:{
            sendMessage(text){
                console.log(text)
            }
        },
        components:{MessageComposer,MessagesFeed}
    }
</script>
<style lang="scss" scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>