<template>
    <div class="row">

        <div class="form-group">
            <button v-show="isSearch" @click="toggleIsSearch" class="btn btn-primary">Show all Contacts</button>
            <button v-show="!isSearch" @click="toggleIsSearch" class="btn btn-primary">Search Mode</button>
            <h1 v-show="!isSearch">Contacts</h1>
        </div>

        <div class="col-md-6">
            <div v-show="!isSearch">
                <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="contact.name" type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>address</label>
                        <input v-model="contact.address" type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input v-model="contact.phone" type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <button v-show="!edit" type="submit" class="btn btn-primary">New Contact</button>
                        <button v-show="edit" type="submit" class="btn btn-primary">Update Contact</button>
                    </div>
                </form>
            </div>
            <div v-show="isSearch">
                <form action="">
                    <div class="form-group">
                        <label>Search By contact Name or Number</label>
                        <input type="text" class="form-control" placeholder="search " v-model="searchInput">
                        <span class="city-span" v-text="searchStatus"></span>
                    </div>
                </form>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item" v-for="contact in contacts">
                <strong>{{contact.name}}</strong> {{contact.address}} {{contact.phone}}
<!--                <button @click="showContact(contact.id)" class="btn btn-default btn-xs">Edit</button>-->
<!--                <button @click="deleteContact(contact.id)" class="btn btn-danger btn-xs">Delete</button>-->
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                isSearch: true,
                edit: false,
                searchInput: '',
                searchStatus: '',
                contacts: [],
                contact: {
                    name: '',
                    address: '',
                    phone: ''
                }
            }
        },
        mounted: function () {
            console.log('Contacts Component Loaded...');
            this.fetchContactList();
        },
        methods: {
            fetchContactList:function(){
                console.log('Fetching contacts...');
                axios.get('api/contacts')
                    .then((response) => {
                        console.log(response.data);
                        this.contacts = response.data;
                    }).catch((error) => {
                    console.log(error);
                });
            },
            createContact: function(){
                console.log('Creating contact...');
                let self = this;
                let params =Object.assign({}, self.contact);
                axios.post('api/contact/store', params)
                    .then(function(){
                        console.log(self.contact);
                        self.contact.name = '';
                        self.contact.email = '';
                        self.contact.phone = '';
                        self.edit = false;
                        self.fetchContactList();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
            updateContact: function () {
                console.log('createing contacnt');
            },
            toggleIsSearch: function () {
                this.isSearch = !this.isSearch;
            }
        }
    }
</script>

