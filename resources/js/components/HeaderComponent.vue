<template>

<nav class="navbar navbar-expand-lg bg-shadow px-2" style="margin-bottom: 37px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="../assets/icons/ET-logo-en.png" alt="Logo" style="width: 30px; margin-bottom: 8px;">
            EBIT Calculation
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a id="subNav-12" class="nav-link fw-semibold dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{ $t('administrator') }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li>
                      <router-link class="dropdown-item fw-semibold " to="/users">{{ $t('users') }}</router-link>
                  </li>
                  <li>
                    <router-link class="dropdown-item fw-semibold " to="/instances">{{ $t('instances') }}</router-link>
                  </li>
                  <li>
                    <router-link class="dropdown-item fw-semibold " to="/order-types">{{ $t('order_types') }}</router-link>
                  </li>

                  <li>
                    <router-link class="dropdown-item fw-semibold " to="/instance-users">{{ $t('instance_users') }}</router-link>
                  </li>
              </ul>

            </li>
            <li class="nav-item hover ">
                <router-link  class="nav-link fw-semibold" to="/orders">{{ $t('orders') }}</router-link>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold-600 js_employee" href="javascript:void(0);">
                        <i class="fas fa-user"></i> Abdujalilov
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle nav-link fw-semibold" href="" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <font-awesome-icon icon="earth-asia" />
                        {{ $t('language') }}  </a>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item fw-semibold  active " @click="changeLanguage('en')">
                                <img src="https://weekly.etc-network.uz/assets/img/usa-flag.png"
                                    class="lang-flag" alt="usa-flag"/> {{ $t('english') }}
                        </button>
                        </li>
                        <li><button class="dropdown-item fw-semibold"  @click="changeLanguage('ru')">
                             <img src="https://weekly.etc-network.uz/assets/img/russian-flag.png" class="lang-flag"
                                    alt="russian-flag"/> {{ $t('russian') }}</button>
                        </li>
                    </ul>
                </li>

                <a class="nav-link fw-semibold" href="" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                          <font-awesome-icon :icon="['fas', 'right-from-bracket']" /> {{ $t('sign_out') }}               </a>
                <form id="logout-form" action="https://weekly.etc-network.uz/logout" method="POST" class="d-none">
                    <input type="hidden" name="token" value="r1DCggJjqfefySEdRQoTm6oZEweuVdvKD7gPJl7G" autocomplete="off">                </form>

            </ul>
        </div>

    </div>


</nav>

</template>

<script>
export default {
  name: 'Header',
  props: {
    msg: String
  },
  methods: {
    changeLanguage(lang) {
      this.$i18n.locale = lang;
      localStorage.setItem('preferred_language', lang);
    },
  },
}
</script>
