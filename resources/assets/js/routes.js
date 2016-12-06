/**
 * Created by d on 16-12-6.
 */
let routes = [
  {
    path : '/',
    component : {template: '<div class="title text-center">Hello</div>'}
  },
  {
    path : '/domains',
    component : require('./components/domain/Domains.vue')
  }
];

export default routes;