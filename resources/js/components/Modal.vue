<template>
  <div @keyup.esc="close">
    <div class="modal-backdrop fade show" :style="{display: active ? 'block' : 'none'}"></div>
    <div id="myModal" class="modal animated" :class="[{ 'show fadeInDown ' : active}]"
         :style="{display: active ? 'block' : 'none', padding : '12px', marginTop: '10px',}"
         tabindex="-1">
      <div class="modal-dialog modal-lg" :style="[{ 'max-width': maxWidth, height: '100%'}]">
        <div class="modal-content" style="min-height:50%">
          <div class="modal-header">
            <h4 class="modal-title">
              <slot name="title"></slot>
            </h4>
            <button type="button" class="close" @click="close()">×</button>
          </div>
          <div class="modal-body" style="overflow: auto">
            <slot></slot>
          </div>
          <div class="modal-footer">
            <slot name="footer"></slot>
            <button type="button" class="btn btn-info waves-effect" @click="close()">إغلاق</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>
<script type="text/babel">
  import { mapState } from 'vuex'

  export default {
    props: {
      active: Boolean,
      maxWidth: {
        type: String,
        default: '1000px'
      }
    },
    components: {},
    methods: {
      close () {
        this.$emit('close')
      }
    }
  }
</script>
<style scoped>
  .animated {
    animation-duration: .500s;
  }
</style>