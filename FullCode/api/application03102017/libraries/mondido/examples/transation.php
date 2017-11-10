<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Mondido PayOut v2.3.7, (c) Mondido Payments AB 2017, hello@mondido.com -->
  <script>
      var mondidoSettings = {
          href: '{{transaction.href}}',

          /// Company layout settings
          layout: {
              name: "{{ transaction.merchant.settings_hosted['v2']['layout']['name'] | default_string_empty_name  }}",
              show_logo: {{ transaction.merchant.settings_hosted['v2']['layout']['show_logo'] | default_false  }},
      logo_url: "{{ transaction.merchant.settings_hosted['v2']['layout']['logo_url'] | default_string_empty_logo  }}",
          terms_and_conditions_url: "{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}",
          accept_terms_requirement: false
      },

      /// Cards/Payment layout settings
      activePaymentMethod: "{{ transaction.merchant.settings_hosted['v2']['active_payment_method'] | default_payment_method  }}",

          supportedCards: {
          amex: {active: true, currencies: ['sek']},
          diners: {active: false},
          jcb: {active: false},
          laser: {active: false},
          electron: {active: true, currencies: ['all']},
          visa: {active: true, currencies: ['all']},
          mastercard: {active: true, currencies: ['all']},
          maestro: {active: true, currencies: ['all']},
          discover: {active: false}
      },

      supportedPaymentMethods: [
          {name: 'credit_card_tab', active: {{ transaction.merchant.settings_hosted['v2']['credit_card']['active'] | default_true }}, currencies:['all'], countries:['all']},
      {name: 'swish_tab', active: {{ transaction.merchant.settings_hosted['v2']['swish']['active'] | default_false }}, currencies:['all'], countries:['se']},
      {name: 'paypal_tab', active: {{ transaction.merchant.settings_hosted['v2']['paypal']['active'] | default_false }}, currencies:['all'], countries:['all']},
      {name: 'trustly_tab', active: {{ transaction.merchant.settings_hosted['v2']['trustly']['active'] | default_false }}, currencies:['all'], countries:['all','se','at','be','bg','hr','cz','cy','dk','ee','fi','fr','de','gr','hu','ie','it','lv','lt','lu','mt','nl','no','pl','pt','ro','sk','si','es','gb']},
      {name: 'invoice_tab', active: {{ transaction.merchant.settings_hosted['v2']['invoice']['active'] | default_false }}, currencies:['all'], countries:['all'],
          segmentation: {
          b2c: {{ transaction.merchant.settings_hosted['v2']['invoice']['segmentation']['b2c'] | default_true }},
          b2b: {{ transaction.merchant.settings_hosted['v2']['invoice']['segmentation']['b2b'] | default_false }},
          defualt: "{{ transaction.merchant.settings_hosted['v2']['invoice']['segmentation']['defualt'] | default_segmentation  }}"
      },
          AgreementCode: "{{ transaction.merchant.settings_hosted['v2']['invoice']['agreement_code'] }}"
      },
      {name: 'masterpass_tab', active: {{ transaction.merchant.settings_hosted['v2']['masterpass']['active'] | default_false }}, currencies:['all'], countries:['all']},
      ],

      /// Config settings
      metadata: '{{ transaction.metadata | replace: "'", "" }}',
      currency: '{{ transaction.currency }}',
          country_code: '{{ transaction.payment_details.country_code | default_country }}',
          metadataCountry: "{{ transaction.metadata['country'] | default_country_name }}",

          customer: {
          name: "{{ transaction.metadata['customer_firstname'] }} {{ transaction.metadata['customer_last'] }}",
              phone: "{{ transaction.metadata['order']['billing_address']['phone'] }}",
              email: "{{ transaction.metadata['email'] }}",

              billing: {
              first_name: "{{ transaction.metadata['order']['billing_address']['first_name'] }}",
                  last_name: "{{ transaction.metadata['order']['billing_address']['last_name'] }}",
                  address1: "{{ transaction.metadata['order']['billing_address']['address1'] }}",
                  phone: "{{ transaction.metadata['order']['billing_address']['phone'] }}",
                  city: "{{ transaction.metadata['order']['billing_address']['city'] }}",
                  zip: "{{ transaction.metadata['order']['billing_address']['zip'] }}",
                  address2: "{{ transaction.metadata['order']['billing_address']['address2'] }}",
                  company: "{{ transaction.metadata['order']['billing_address']['company'] }}"
          }
      },

      convertCurrency: {
          amount: "{{ transaction.convert_currency['amount'] }}",
              currency: "{{ transaction.convert_currency['currency'] }}",
              methods: "{{ transaction.convert_currency['payment_methods'] }}"
      },

      config: {
          system: {
              endpoint: "{{ transaction.merchant.settings_hosted['v2']['system']['endpoint']['pay'] | default_endpoint  }}",
                  log: false,
                  payment_js_endpoint: "{{ transaction.merchant.settings_hosted['v2']['system']['endpoint']['payment_js'] | default_payment_js_endpoint  }}",
                  lang_endpoint: "{{ transaction.merchant.settings_hosted['v2']['system']['endpoint']['lang'] | default_lang_endpoint  }}",
                  css_endpoint: "{{ transaction.merchant.settings_hosted['v2']['system']['endpoint']['css'] | default_css_endpoint  }}"
          }
      }
      }

      if(document.Mondido != undefined && document.Mondido.systemInfo){
          //problems:[{type: 'swish', message: 'Swish is out of order'},{type: 'credit_card', issuer: 'nordea', message: 'Nordea kräver 3D Secure'}]
          mondidoSettings.systemInfo = document.Mondido.systemInfo;
      }
      if (document.location.host) { mondidoSettings.config.development = false; } else { mondidoSettings.config.development = true; }
  </script>
  <link rel="stylesheet" href="https://cdn-02.mondido.com/pay-out/v2/css/multi.2.0.1.css" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="robots" content="noindex, nofollow"/>
  <title>{{ transaction.merchant.settings_hosted['v2']['layout']['name'] | default_string_empty_name  }} payment window</title>
</head>
<body>

{% assign show_campaigns = false %}
{% assign show_subscription_plan = default_false %}
{% assign show_logo = transaction.merchant.settings_hosted['v2']['layout']['show_logo'] | default_true %}
{% assign show_credit_card = transaction.merchant.settings_hosted['v2']['credit_card']['active'] | default_true %}
{% assign show_swish = transaction.merchant.settings_hosted['v2']['swish']['active'] | default_false %}
{% assign show_trustly = transaction.merchant.settings_hosted['v2']['trustly']['active'] | default_false %}
{% assign show_paypal = transaction.merchant.settings_hosted['v2']['paypal']['active'] | default_false %}
{% assign show_invoice = transaction.merchant.settings_hosted['v2']['invoice']['active'] | default_false %}
{% assign show_masterpass = transaction.merchant.settings_hosted['v2']['masterpass']['active'] | default_false %}

{% assign show_powered_by = transaction.merchant.settings_hosted['v2']['layout']['show']['powered_by'] | default_true %}

{% assign show_card_visa = transaction.merchant.settings_hosted['v2']['supported_cards']['visa']['active'] | default_true %}
{% assign show_card_mastercard = transaction.merchant.settings_hosted['v2']['supported_cards']['mastercard']['active'] | default_true %}
{% assign show_card_amex = transaction.merchant.settings_hosted['v2']['supported_cards']['amex']['active'] | default_false %}

<div class="load-center mondido-load">
  <div class="sk-circle">
    <div class="sk-circle1 sk-child"></div>
    <div class="sk-circle2 sk-child"></div>
    <div class="sk-circle3 sk-child"></div>
    <div class="sk-circle4 sk-child"></div>
    <div class="sk-circle5 sk-child"></div>
    <div class="sk-circle6 sk-child"></div>
    <div class="sk-circle7 sk-child"></div>
    <div class="sk-circle8 sk-child"></div>
    <div class="sk-circle9 sk-child"></div>
    <div class="sk-circle10 sk-child"></div>
    <div class="sk-circle11 sk-child"></div>
    <div class="sk-circle12 sk-child"></div>
  </div>
</div>

<div id="paymentArea" class="mondido-payment" style="display:none;">
  <div id="payform" class="container">

    {% if show_logo == true %}
    <div class="m-layout-show-logo col-xs-12 text-center hidden">
      <img class="m-layout-logo" src="https://cdn-02.mondido.com/pay-out/v2/img/mondido-logo.png" alt="Logo" />
    </div>
    {% endif %}

    <div data-mulang="choose_payment_option" class="row text-center choose mulang text-choose-payment">
      Please choose payment option
    </div>

    <!-- ######### Nav tabs ######### -->
    <div role="tabpanel" id="payment-tabpanel">
      <ul id="mondidoPaymentTab" class="nav nav-tabs" role="tablist" >
        {% if show_credit_card == true %}
        <li role="presentation" class="credit_card_tab tab-process-payment" style="display:none;">
          <a href="#credit_card_tab" aria-controls="credit_card_tab" role="tab" data-toggle="tab" class="card-tab">
            {% if show_card_mastercard == true %}
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/mastercard-logo.svg" alt="Mastercard logo"/>
            {% endif %}
            {% if show_card_visa == true %}
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/visa-logo.svg" alt="Visa logo"/>
            {% endif %}
            <small data-mulang="card_payment" class="small_tab_text mulang">Card</small>
          </a>
        </li>
        {% endif %}

        {% if show_swish == true %}
        <li role="presentation" class="swish_tab tab-process-payment" style="display:none;">
          <a href="#swish_tab" aria-controls="swish_tab" role="tab" data-toggle="tab">
            <img src="https://cdn-02.mondido.com/pay-out/v2/img/swish-logo.png" alt="Swish">
            <small data-mulang="swish_payment" class="small_tab_text mulang">Swish</small>
          </a>
        </li>
        {% endif %}

        {% if show_trustly == true %}
        <li role="presentation" class="trustly_tab tab-process-payment" style="display:none;">
          <a href="#trustly_tab" aria-controls="trustly_tab" role="tab" data-toggle="tab">
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/trustly-logo.png" style="max-width: 50px;" alt="Trustly logo"/>
            <small data-mulang="bank_payment" class="small_tab_text mulang">Bank</small>
          </a>
        </li>
        {% endif %}

        {% if show_paypal == true %}
        <li role="presentation" class="paypal_tab tab-process-payment" style="display:none;">
          <a href="#paypal_tab" aria-controls="paypal_tab" role="tab" data-toggle="tab">
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/paypal-logo.svg" style="max-width: 50px;" alt="PayPal logo"/>
            <small data-mulang="paypal_payment" class="small_tab_text mulang">PayPal</small>
          </a>
        </li>
        {% endif %}

        {% if show_invoice == true %}
        <li role="presentation" class="invoice_tab tab-process-payment" style="display:none;">
          <a href="#invoice_tab" aria-controls="invoice_tab" role="tab" data-toggle="tab" class="card-tab" >
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/invoice-logo.png" style="max-width: 15px;" alt="PayPal logo"/>
            <small data-mulang="invoice_payment" class="small_tab_text mulang">Invoice</small>
          </a>
        </li>
        {% endif %}

        {% if show_masterpass == true %}
        <li role="presentation" class="masterpass_tab tab-process-payment" style="display:none;">
          <a href="#masterpass_tab" aria-controls="masterpass_tab" role="tab" data-toggle="tab" class="tab" >
            <img src="https://static.masterpass.com/dyn/img/acc/global/mp_mc_acc_034px.svg" style="max-height: 16px;" alt="Masterpass" />
            <small class="small_tab_text masterpass_small_text mulang">Masterpass</small>
          </a>
        </li>
        {% endif %}

      </ul>
    </div>
    <!-- ######### Tab panes ######### -->
    <div id="myTabsegmentation_toggleContent" class="row tab-content">
      <div class="row header">
        <div class="col-xs-12 text-center">
          <p class="amount mulang" data-mulang="amount['{{ transaction.amount | round }}','{{ currency }}']">
            {{ transaction.amount | round }} {{ currency }}
          </p>
          <div id="currencyConvert" class="col-xs-12 text-center hidden" style="margin-bottom:20px;"></div>
          <div id="errors" class="alert alert-danger state-error"></div>
        </div>
      </div>

      <div class="load-process-payment text-center" style="display:none;">
        <div class="sk-circle">
          <div class="sk-circle1 sk-child"></div>
          <div class="sk-circle2 sk-child"></div>
          <div class="sk-circle3 sk-child"></div>
          <div class="sk-circle4 sk-child"></div>
          <div class="sk-circle5 sk-child"></div>
          <div class="sk-circle6 sk-child"></div>
          <div class="sk-circle7 sk-child"></div>
          <div class="sk-circle8 sk-child"></div>
          <div class="sk-circle9 sk-child"></div>
          <div class="sk-circle10 sk-child"></div>
          <div class="sk-circle11 sk-child"></div>
          <div class="sk-circle12 sk-child"></div>
        </div>
        <div data-mulang="processing_secure_payment" class="mulang">Processing secure payment</div>
      </div>

      {% if show_credit_card == true %}
      <!-- card -->
      <div role="tabpanel" class="tab-pane fade mondido-process-payment" id="credit_card_tab" aria-labelledBy="credit_card_tab">
        <!-- ######### CARD ######### - ######### START ######### -->
        <div class="row">
          <form id="mondidopayform" class="form-signin" method="post" autocomplete="on" novalidate>
            <input type="hidden" name="card_expiry" id="card_expiry" value="" />

            {% if show_subscription_plan == true %}
            <div class="plans">
              <label>Select subscription plan</label>
              <select tabindex="1" class="form-control" name="plan_id" id="plans">
                {% for item in transaction.merchant.plans %}
                <option value="{{ item['id'] }}">{{ item['name'] }}</option>
                {% endfor %}
              </select>
            </div>
            {% endif %}

            <div class="card_holder_name">
              <label id="label_card_holder" data-mulang="card_holder" class="mulang">
                Card holder name:
              </label>
              <input id="input_card_holder" data-mulang="card_holder_placeholder:placeholder" placeholder="Firstname Lastname"  type="text" class="form-control mulang m-ent-tab" name="card_holder" value="{{ transaction.metadata['customer']['firstname'] }} {{ transaction.metadata['customer']['lastname'] }}" tabindex="1" autocomplete="cc-name" autofocus />
            </div>
            <label data-mulang="card_number" class="mulang">
              Card number:
            </label>
            <div class="card_number_div">
              <span class="cc-brand"></span>
              <input data-mulang="card_number_placeholder:placeholder" data-numeric type="tel" class="mulang form-control identified cc-number m-ent-tab" id="card_number" name="card_number" placeholder="•••• •••• •••• ••••" value="" maxlength="19" tabindex="2" />
              <div class="cards">
                <div data-mulang="card_not_accepted" class="arrow_box mulang">Card is currently not supported</div>
              </div>
            </div>
            <label hidden>
              Card Type
            </label>
            <input type="hidden" class="form-control" name="card_type" id="card_type"/>
            <div class="row">
              <div class="col-xs-4 nopadleft">
                <label data-mulang="exp_month" class="mulang">
                  Month:
                </label>
                <input type="tel" class="form-control cc-exp cc-number m-ent-tab" maxlength="2" id="expMM" name="expMM" placeholder="01" tabindex="3" required pattern="\d*" />
              </div>
              <div class="col-xs-4">
                <label data-mulang="exp_year" class="mulang">
                  Year:
                </label>
                <input type="tel" class="form-control cc-exp cc-number m-ent-tab" maxlength="2" id="expYY" name="expYY" placeholder="16" tabindex="4" required pattern="\d*" />
              </div>
              <div class="col-xs-4 nopadright">
                <label data-mulang="cvc" class="mulang">
                  CVV:
                </label>
                <input type="tel" class="form-control cc-cvc cc-number" maxlength="4" id="card_cvv" name="card_cvv" placeholder="•••" tabindex="5" required pattern="\d*" autocomplete="off" />
              </div>
            </div>

            <div style="margin: 20px 0px; display:none;" class="accept-payment-terms-div">
              <input type="checkbox" id="accept-payment-terms-credit-card" name="accept-payment-terms-credit-card" /> Ja, <a href="{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}" target="_blank">Jag accepterar villkoren</a>
            </div>

            <input data-mulang="pay_button:value" id="paybtn-cc" class="mulang btn btn-lg btn-success btn-block" type="submit" value="Pay" tabindex="6"/>
            <div class="footer">
              <div class="row text-center">
                <div class="col-xs-6">
                  {% if show_card_visa == true %}
                  <img class="card-img" src="https://cdn-02.mondido.com/pay-out/v2/img/visa-logo.svg" style="max-width: 40px;" alt="Visa logo"/>
                  {% endif %}

                  {% if show_card_mastercard == true %}
                  <img class="card-img" src="https://cdn-02.mondido.com/pay-out/v2/img/mastercard-logo.svg" style="max-width: 40px;" alt="Mastercard"/>
                  {% endif %}

                  {% if show_card_amex == true %}
                  <img class="card-img" src="https://cdn-02.mondido.com/pay-out/v2/img/americanexpress-logo.svg" style="max-width: 40px;" alt="American Express logo"/>
                  {% endif %}
                </div>
                <div class="col-xs-6">
                  <img class="card-img" src="https://cdn-02.mondido.com/pay-out/v2/img/3dsecure.png" alt="3d secure"/>
                </div> </div>
              <div class="comodotext mulang" data-mulang="safe_text">
                Your payment is made safe by Mondido. The store will never be in contact with your credit card information, all the information is sent encrypted to your bank. Mondido is PCI DSS Level 1 certified and use HTTPS / TLS, which is the banking industry standard for secure e-commerce transactions.
              </div>
            </div>
            <p class="clearfix">
            </p>
          </form>
        </div>
        <!-- ######### CARD ######### - ######### END ######### -->
      </div>
      <!-- /card -->
      {% endif %}

      {% if show_trustly == true %}
      <!-- trustly -->
      <div role="tabpanel" class="tab-pane fade text-center mondido-process-payment" id="trustly_tab" aria-labelledBy="trustly_tab" style="text-align: center;">
        <!-- ######### Trustly ######### - ######### START ######### -->

        <form action="javascript:void(0);" id="trustlyform" method="post"  class="trustly-frame"  target="trustly">
          <input type="hidden" name="trustly" value="1" />
          <input type="hidden" name="trustly_locale" value="sv_SE" />
          <input type="hidden" name="trustly_country" value="SE" />
        </form>
        <iframe src="" name="trustly" class="trustly-frame" height="400" style="border: 0; width:95%; "></iframe>


        <div class="row center-block text-center accept-payment-terms-div" style="display:none;">
          <form action="javascript:void(0);" class="form-signin go-bottom " id="trustlyform-terms" method="post"  >

            <div class="row" style="margin: 20px 0px;">
              <div class="mulang" data-mulang="easily_pay_with_trustly">Pay with Trustly</div>
            </div>

            <div class="row" style="margin: 20px 0px;">
              <input type="checkbox" id="accept-payment-terms-trustly" name="accept-payment-terms-trustly" /> Ja, <a href="{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}" target="_blank">Jag accepterar villkoren</a>
            </div>

            <div class="row spacer">
              <input id="paybtn-trustly" class="btn btn-lg btn-success btn-block" type="submit" value="Betala" tabindex="5">
            </div>

          </form>

          <div class="mulang" data-mulang="what_is_trustly">What is Trustly?</div>

        </div>
        <!-- ######### TRUSTLY ######### - ######### END ######### -->
      </div>
      <!-- /trustly -->
      {% endif %}

      {% if show_swish == true %}
      <!-- swish -->
      <div role="tabpanel" class="tab-pane fade mondido-process-payment" id="swish_tab" aria-labelledBy="swish_tab" style="text-align: center;">
        <!-- ######### SWISH ######### - ######### START ######### -->
        <form action="javascript:void(0);" class="form-signin go-bottom" id="swishform" method="post" >
          <input type="hidden" name="swish" value="1" />
          <div class="row">
            <div class="mulang" data-mulang="easily_pay_with_swish_mobile">Pay with Swish Mobile</div>
            <img class="swish-img " src="https://cdn-02.mondido.com/www/img/swish_tre_mobiler.png" alt="Swish"/>
          </div>
          <div class="row spacer col-xs-12">
            <input type="tel"  class="form-control cc-number" id="swish_number" name="swish_number" placeholder="4670112233" value="" tabindex="1" />
            <label for="swish_number" class="mulang" data-mulang="your_mobile_number">>Your mobile number</label>
          </div>

          <div style="margin: 20px 0px; display:none;" class="accept-payment-terms-div">
            <input type="checkbox" id="accept-payment-terms-swish" name="accept-payment-terms-swish" /> Ja, <a href="{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}" target="_blank">Jag accepterar villkoren</a>
          </div>

          <div class="row spacer">
            <input id="paybtn-swish" class="btn btn-lg btn-success btn-block" type="submit" value="Betala" tabindex="5">
          </div>
        </form>
        <!-- ######### SWISH ######### - ######### END ######### -->
      </div>
      <!-- /swish -->
      {% endif %}

      {% if show_paypal == true %}
      <!-- paypal-->
      <div role="tabpanel" class="tab-pane fade mondido-process-payment" id="paypal_tab" aria-labelledBy="paypal_tab" style="text-align: center;">
        <!-- ######### PAYPAL ######### - ######### START ######### -->
        <form action="javascript:void(0);" class="form-signin" id="paypalform" method="post" >
          <input type="hidden" name="paypal" value="1" />
          <div class="row spacer">
            <div class="mulang" data-mulang="paypal_hl">Pay easily with PayPal</div>
            <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/paypal-logo.svg"  style="max-width: 200px;" alt="PayPal logo"/>
          </div>

          <div style="margin: 20px 0px; display:none;" class="accept-payment-terms-div">
            <input type="checkbox" id="accept-payment-terms-paypal" name="accept-payment-terms-paypal" /> Ja, <a href="{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}" target="_blank">Jag accepterar villkoren</a>
          </div>

          <div class="row spacer">
            <input data-mulang="paypal_btn:value" id="paybtn-paypal" class="mulang btn btn-lg btn-success btn-block" type="submit" value="Betala med PayPal" tabindex="5">
          </div>
        </form>
        <!-- ######### PAYPAL ######### - ######### END ######### -->
      </div>
      <!-- /paypal-->
      {% endif %}

      {% if show_masterpass == true %}
      <!-- masterpass-->
      <div role="tabpanel" class="tab-pane fade mondido-process-payment" id="masterpass_tab" aria-labelledBy="masterpass_tab" style="text-align: center;">
        <!-- ######### MASTERPASS ######### - ######### START ######### -->
        <form action="javascript:void(0);" class="form-signin" id="masterpassform" method="post" >
          <input type="hidden" name="masterpass" value="1" />
          <div class="row spacer">
            <div style="margin-bottom:25px;">Pay with Masterpass</div>

            <div style="margin: 20px 0px; display:none;" class="accept-payment-terms-div">
              <input type="checkbox" id="accept-payment-terms-masterpass" name="accept-payment-terms-masterpass" /> Ja, <a href="{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}" target="_blank">Jag accepterar villkoren</a>
            </div>

            <a href="#" id="checkoutButtonDiv">
              <img src="https://static.masterpass.com/dyn/img/btn/global/mp_chk_btn_290x068px.svg" alt="Buy with Masterpass" >
            </a>
          </div>
          <div id="mpspin" style=""></div>
          <div class="row spacer">
            <a href="http://www.mastercard.com/mc_us/wallet/learnmore/se/" target="_blank" id="masterpassMore">Learn more about Masterpass</a>
          </div>
        </form>
        <!-- ######### MASTERPASS ######### - ######### END ######### -->
      </div>
      <!-- /masterpass-->
      {% endif %}

      {% if show_invoice == true %}
      <!-- invoice -->
      <div role="tabpanel" class="tab-pane fade mondido-process-payment" id="invoice_tab" aria-labelledBy="invoice_tab">
        <!-- ######### INVOICE ######### - ######### START ######### -->
        <form id="invoiceform" class="form-signin go-bottom" method="post" >
          <input type="hidden" id="payment_method" name="payment_method"/>
          <input type="hidden" id="country_code" name="country_code" value="{{ transaction.payment_details.country_code }}"/>
          <input type="hidden" id="pending_payment_customer" name="pending_payment_customer"/>
          <input type="hidden" id="segmentation" name="segmentation" value="{{{ transaction.payment_details.segmentation }}" />

          <div class="row " id="segmentation_toggle" style="margin-bottom:5px;">
            <div class="row pull-right">
              <a href="#" class="state-segmentation state-segmentation-click b2b set-b2c ">
                <span class="mulang" data-mulang="individual">Individual?</span>
              </a>
              <a href="#" class="state-segmentation state-segmentation-click b2c set-b2b">
                <span class="mulang" data-mulang="business">Business?</span>
              </a>
            </div>
          </div>

          <div class="row spacer" id="row-email">

            <div class="col-xs-12">
              <input type="text" class="form-control next-email mulang m-ent-tab" maxlength="255" id="email" name="email" placeholder="Your email address" tabindex="1" value="{{ transaction.payment_details.email }}" autocomplete="email" autofocus />
              <label for="email" data-mulang="your_email_address" class="mulang ">Your email address</label>
            </div>

          </div>
          <div class="row hidden spacer state-show-all-details" id="row-phone-details">

            <div class="col-xs-12">
              <input data-numeric type="tel" class="form-control next-phone mulang m-ent-tab" id="phone" name="phone" placeholder="Your phone number" value="{{ transaction.payment_details.phone }}" maxlength="20" tabindex="2"   />
              <label for="phone" data-mulang="your_phone_number" class="mulang">Your phone number</label>
            </div>

          </div>
          <div class="row hidden spacer state-show-all-details" id="row-ssn-details">

            <div class="col-xs-12">

              <input data-numeric type="tel" class="form-control next-ssn mulang m-ent-tab" id="ssn" name="ssn" placeholder="ååååmmdd ••••" value="{{ transaction.payment_details.ssn }}" maxlength="13" tabindex="3"  />
              <label for="ssn" data-mulang="your_social_security_number" class="mulang">Your Social Security number</label>
            </div>
          </div>

          <div class="row hidden state-load">
            <div class="col-xs-12 mulang" id="loading" data-mulang="loading">
              Loading
            </div>
            <div class="col-xs-12">
              <div class="sk-circle" style="margin: 20px auto;">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
              </div>
            </div>
          </div>
          <div class="row hidden state-error">
            <div class="col-xs-12 error mulang" data-mulang="invoice_address_could_not_be_retrieved">
              Your address could not be retrieved. Check that you have entered the correct Social Security number. Example 198605141234
            </div>
          </div>

          <div class="row hidden state-show-all-details state-customer-details">

            <div class="row spacer ">
              <div class="col-xs-6 ">
                <input type="text" data-mulang="first_name:placeholder" class="form-control mulang invoice-input m-ent-tab " maxlength="35" id="first_name" name="first_name" placeholder="First name" tabindex="4" value="{{ transaction.payment_details.mask_first_name }}" disabled/>
                <label for="first_name" data-mulang="first_name" class="mulang ">First name</label>
              </div>
              <div class="col-xs-6 ">
                <input type="text" data-mulang="last_name:placeholder" class="form-control mulang invoice-input m-ent-tab " maxlength="35" id="last_name" name="last_name" placeholder="Last name" tabindex="4" value="{{ transaction.payment_details.mask_last_name }}" disabled/>
                <label for="last_name" data-mulang="last_name" class="mulang ">Last name</label>
              </div>
            </div>

            <div class="row spacer state-segmentation b2b">
              <div class="col-xs-12 state-segmentation b2b">
                <input type="text" data-mulang="company_name:placeholder" class="form-control mulang invoice-input m-ent-tab state-segmentation b2b" maxlength="12" id="company_name" name="company_name" placeholder="First name" tabindex="4" value="{{ transaction.payment_details.company_name }}" disabled/>
                <label for="company_name" data-mulang="company_name" class="mulang">Company name</label>
              </div>
            </div>

            <div class="row spacer">
              <div class="col-xs-12">
                <div class="address">
                  <input data-text data-mulang="address:placeholder"  type="text" class="form-control mulang invoice-input m-ent-tab" id="address_1" name="address_1" value="{{ transaction.payment_details.mask_address_1 }}" maxlength="255" placeholder="Address" tabindex="5" disabled/>
                  <label for="address_1" data-mulang="address" class="mulang">Address</label>
                </div>
              </div>
            </div>
            <div class="row spacer hidden invoice-address-2">
              <div class="col-xs-12">
                <div class="address">
                  <input data-text data-mulang="co_address:placeholder"  type="text" class="form-control mulang invoice-input m-ent-tab" id="address_2" name="address_2" value="{{ transaction.payment_details.mask_address_2 }}" maxlength="255" placeholder="C/O Adress" tabindex="6" disabled/>
                  <label for="address_2" data-mulang="co_address" class="mulang">C/O Adress</label>
                </div>
              </div>
            </div>
            <div class="row spacer">
              <div class="col-xs-6">
                <input type="text" data-mulang="zip:placeholder" class="form-control mulang invoice-input m-ent-tab" maxlength="12" id="zip" name="zip" placeholder="zip" tabindex="7" value="{{ transaction.payment_details.mask_zip }}" disabled/>
                <label for="zip" data-mulang="zip" class="mulang">Zip code</label>
              </div>
              <div class="col-xs-6">
                <input type="text" data-mulang="city:placeholder" class="form-control mulang invoice-input m-ent-tab" maxlength="255" id="city" name="city" placeholder="City" tabindex="8" value="{{ transaction.payment_details.mask_city }}" disabled/>
                <label for="city" data-mulang="city" class="mulang">City</label>
              </div>
            </div>

            {% if show_campaigns == true %}
            <div class="row ">
              <div class="col-xs-12">
                <input type="radio" name="campaign" value="" checked> Faktura, skicka som epost<br /><br />
                <span style="font-size: 12px;">Delbetalning</span>
                <p>
                  {% for country_campaign in transaction.campaigns %}
                  {% for campaign in country_campaign[{{transaction.metadata['country'] | default_country_name}}] %}
                  <input type="radio" name="campaign" value="{{ campaign.value }}"> {{ campaign.name }} <br>
                  {% endfor %}
                  {% endfor %}
                </p>
              </div>
            </div>
            {% endif %}

            <div class="row ">
              <div class="col-xs-12">
                <p>
                  <input type="checkbox" class="accept-terms mulang" id="accept-payment-terms-invoice" name="cheese" value="yes"  data-mulang="i_accept:placeholder" tabindex="9"  />
                  <span id="accept_collector" class="mulang accept_collector" data-mulang="invoice_accept_conditions['{{ transaction.merchant.settings_hosted['v2']['layout']['name'] | default_string_empty_name  }}', '{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}', '{{ transaction.merchant.settings_hosted['v2']['invoice']['agreement_code'] }}', '{{ transaction.merchant.settings_hosted['v2']['invoice']['agreement_code'] }}']" style="font-size: 12px;">
                            Yes, I have read and accept Collector Bank\'s
                            <a target="new" href="https://www.collector.se/upload/Partners/Agreements/AgreementCode/Credit_terms_All_SE.pdf">
                              General Conditions For Invoice And Credit Accounts
                            </a> and
                            <a target="new" href="https://www.collector.se/upload/Partners/Agreements/AgreementCode/SECCI_SE.pdf">
                              Standardised European Consumer Credit Information
                            </a>, and
                            <a target="new" href="url">
                              Conditions #COMPANY#
                            </a>
                        </span>
                </p>
              </div>
            </div>

            <div class="row">
              <input data-mulang="pay_button:value" id="paybtn-invoice" class="btn btn-lg btn-success btn-block mulang" type="submit" value="Pay" tabindex="9"/>
            </div>
          </div>

          <div class="row footer comodotext" id="invoice_foot">
            <div class="text-center">
              <img class="" src="https://cdn-02.mondido.com/pay-out/v2/img/collector-bank-logo.svg" style="max-width: 200px;" alt="Collector bank logo"/>
            </div>
            <span class="mulang" data-mulang="invoice_footer_conditions" >
                      When you select the invoice you will receive your goods before you pay. You can then choose to pay the whole amount at once or split the payment into smaller parts . In order to deal with the bill collectors will be at least 18 years. The invoice will be sent by e-mail. More information can be found at
                  </span> <a target="new" href="https://www.collector.se">https://www.collector.se</a>
          </div>
        </form>
        <!-- ######### INVOICE ######### - ######### END ######### -->
      </div>
      <!-- /invoice -->
      {% endif %}

    </div>
  </div>
</div>

<div class="row mondido-payment mondido-process-payment" style="display:none;">
  <div class="col-xs-12" style="text-align:center;">
    <span class="" id="languages" ></span>
  </div>
</div>

{% if show_powered_by == true %}
<div class="row mondido-payment mondido-process-payment" id="poweredBy" style="display:none;">
  <div class="col-xs-12" style="text-align:center;">
    <span class="mulang" data-mulang="powered_by">Powered by</span>
    <a href="https://www.mondido.com/en/about-us" target="_blank">
      <img class="logo" src="https://cdn-02.mondido.com/pay-out/v2/img/mondido-logo.png" alt="Logo" />
    </a>
  </div>
</div>
{% endif %}

{% if show_credit_card == true %}
<div data-mulang="failed_message" id="try-again" class="hidden mulang">
  Your payment was declined, please try again with a new card or verify your numbers.
</div>
<div data-mulang="validation_message" id="validation-error" class="hidden mulang">
  All fields need to be filled in. Whats missing is:\n
</div>
<div data-mulang="card_not_accepted" id="badcard" class="hidden mulang">
  {card} is not accepted
</div>
<div data-mulang="card_number" id="err_cardnumber" class="hidden mulang">
  Card number,
</div>
<div data-mulang="card_holder" id="err_cardholder" class="hidden mulang">
  Card holder name,
</div>
<div data-mulang="cvc" id="err_cvv" class="hidden mulang">
  CVV/CVV2-code,
</div>
<div data-mulang="expiry" id="err_expiry" class="hidden mulang">
  Expiry date
</div>
{% endif %}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn-02.mondido.com/www/js/lang.2.3.6.js" type="text/javascript"></script>

<script type="text/javascript">
    //checking if agreement_code is country specific (has a comma)
    var agreementCode = '{{ transaction.merchant.settings_hosted['v2']['invoice']['agreement_code'] }}';
    if (agreementCode.indexOf(',') > -1) {
        //agreement_code is country specific
        //checking the country_code is not empty
        var country_code = '{{ transaction.payment_details.country_code | default_country }}';
        country_code = country_code.trim();
        if (country_code != '') {
            var agreementCodeArray = agreementCode.split(',');
            for (var i = 0; i < agreementCodeArray.length; i++) {
                var agreementCodeSpecific = agreementCodeArray[i];
                agreementCodeSpecific = agreementCodeSpecific.trim();
                if(agreementCodeSpecific.indexOf(country_code) > -1){
                    var specificCode = agreementCodeSpecific.split('=')[1];
                    console.log(specificCode);
                    $("#accept_collector").attr("data-mulang", "invoice_accept_conditions['{{ transaction.merchant.settings_hosted['v2']['layout']['name'] | default_string_empty_name  }}', '{{ transaction.merchant.settings_hosted['v2']['terms_and_conditions']['fallback'] | default_string_empty_terms }}', '" + specificCode + "', '" + specificCode + "']");
                    break;
                }
            }
        }
    }
</script>

<script src="https://cdn-02.mondido.com/pay-out/v2/js/mondido.payment.2.3.8.js" type="text/javascript"></script>

{% if show_masterpass == true %}
<script src="https://static.masterpass.com/lightbox/Switch/integration/MasterPass.client.js" type="text/javascript"></script>
{% endif %}

<script type="text/javascript">
    $( document ).ready(function() {
      alert('hii');
        $('.mondido-load').hide();
        $('.mondido-payment').fadeIn(500);
    });
</script>
</body>
</html>