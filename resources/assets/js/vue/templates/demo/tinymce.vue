<template>
    <div class="container margin-top-70">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12">
                <h1>TinyMCE</h1>
            </div>
            <div class="col-xs-12">
                <tinymce v-model="text"></tinymce>
            </div>
            <div class="col-xs-12 margin-top-20 text-center">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" :class="{ 'active': view == 'preview'}" v-on:click="view = 'preview'">Preview</button>
                    <button type="button" class="btn btn-default" :class="{ 'active': view == 'source'}" v-on:click="view = 'source'">Source</button>
                </div>
            </div>
            <div class="col-xs-12 margin-top-20">
                <div v-if="view == 'preview'" v-html="text"></div>
                <textarea v-if="view == 'source'" style="width: 100%; height: 200px; resize: none;" v-model="text"></textarea>
            </div>
        </div>
    </div>
</template>
<script>
    import tinymce from '../components/tinymce.vue'

    export default {
        components: { tinymce },
        data() {
            return {
                view: 'preview',
                text: '<p>Default text</p>'
            }
        }
    }
</script>