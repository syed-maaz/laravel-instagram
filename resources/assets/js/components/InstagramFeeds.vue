<template>

    <div>
        <div class="col-sm-12">
            <div class="row">
                <h2>Search Instagram User</h2>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form method="post" v-on:submit.prevent="searchInsta">
                            <input type="text" v-model="search_query" class="search-query form-control" placeholder="Search" />
                            <span class="input-group-btn">
                                <!--<button class="btn btn-danger" type="button">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>-->
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <div class="row page-header">
            <h3>User Posts</h3>
        </div>

        <div v-for="post in instaPosts" class="row panel panel-default">
            <div class="panel-heading" >
                <img :src="post.images.low_resolution.url" />
            </div> 

            <div class="panel-body" v-if="post.caption">
                {{post.caption.text}}
            </div>

            <div class="panel-footer clearfix" v-if="post.location">
                <a href="" v-if="post.location">
                     <i  class="fa fa-map-marke"></i>{{post.location.name}}
                </a>
                <savepost :post=post.id></savepost>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        // props: ['search_query', 'instaPosts'],

        data: function() {
            return {
                search_query: '',
                instaPosts: []
            }
        },

        methods: {
            searchInsta: function() {
                console.log(this.search_query);


                this.$http.get('/instagram?username=' + this.search_query).then((data) => {
                             this.instaPosts = data.body.items; console.log(this.instaPosts);    
                          })
                          
            } 
        }
/*
        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }*/
    }
</script>