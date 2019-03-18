@extends('layouts_admin.master')

@section('content')

<page-form :attributes="{{ $page }}" inline-template v-cloak>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card @keyup="enable">
            <v-card-title>Pages</v-card-title>

            <v-form>
              <v-container>
                <v-flex>
                  <v-text-field
                    label="Title"
                    name="title"
                    v-model="title"
                    @keyup="slugify"
                    required>
                  </v-text-field>
                  <p class="text-danger" v-if="errors.title" v-text="errors.title[0]"></p>
                </v-flex>

                <v-flex>
                  <v-text-field name="slug" label="Slug" v-model="slug" required></v-text-field>
                   <p class="text-danger" v-if="errors.slug" v-text="errors.slug[0]"></p>
                </v-flex>

                <v-flex>
                  <label>Description</label>
                  <p class="text-danger" v-if="errors.description" v-text="errors.description[0]"></p>
                  <editor
                    :plugins="plugins"
                    :toolbar="toolbars"
                    :init="{ file_browser_callback }"
                    ref="tinymce"
                    v-model="description"
                    rows="10"
                    @onKeyUp="enable"
                  ></editor>
                </v-flex>
              </v-container>
              <v-btn
                type="submit"
                color="primary"
                @click="updatePage"
                :disabled="disabled">Submit</v-btn>
              <v-btn href="/pages" color="error">Cancel</v-btn>
            </v-form>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</page-form>

@endsection