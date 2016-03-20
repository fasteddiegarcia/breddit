'use strict';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var PostModel = Backbone.Model.extend({
    urlRoot: '/api/posts/',
    idAttribute: 'id',
});

var SubbredditModel = Backbone.Model.extend({
    urlRoot: '/api/subbreddits/',
    idAttribute: 'id'
});

var CommentModel = Backbone.Model.extend({
    urlRoot: '/api/comments/',
    idAttribute: 'id'
});

var PostsCollection = Backbone.Collection.extend({
    url: '/api/posts/',
    model: PostModel
});

var SubbredditsCollection = Backbone.Collection.extend({
    url: '/api/subbreddits/',
    model: SubbredditModel
});

var CommentsCollection = Backbone.Collection.extend({
    url: '/api/comments/',
    model: CommentModel
});

var PostItemView = Backbone.View.extend({
    el:'<div class="hello"></div>',

    template: _.template('<h2><%= post.get("title") %></h2>'),

    render: function() {
        this.$el.html(this.template({ post: this.model }));
    }
});

var PostsListView = Backbone.View.extend({
    el: '<ul></ul>',

    template: undefined,

    render: function() {
        var that = this;
        this.collection.each(function(postModel) {
            var postItemView = new PostItemView({ model: postModel});
            postItemView.render();
            this.el.append(postItemView.el);
        });
    }
});

/*
var post = new PostModel({id: 1});

post.fetch({
    success: function() {
        var postItemView = new PostItemView({ model: post });
        postItemView.render();

        $('#content').html(postItemView.el);
    }
});
*/

var posts = new PostsCollection();

posts.fetch({
    success: function() {
        var PostsListView = new PostsListView({collection: posts});
        PostsListView.render();

        $('#content').html(PostsListView.el);
        console.log('view inserted');
    }
});
