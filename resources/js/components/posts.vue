<template>
    <div class="container">
<!--        @foreach($posts as $post)-->
            <div class="post-preview">
                <a href="slug">
    <!--                {{route('posted.show', $post->id)}}-->
                    <h2 class="post-title">
                       {{ title }}
                    </h2>
                    <h3 class="post-subtitle">
                        {{ subtitle }}
                    </h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="!">Start Bootstrap</a>
                    {{ reated_at }}
                    <br>
                    <small> 0 </small>
                    <a href="#"><i class="fa-solid fa-thumbs-up"></i></a>
                </p>
            </div>
<!--        @endforeach-->
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
