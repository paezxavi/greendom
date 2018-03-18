<template>
    <div class="container">
        <h2>Home</h2>

            <div class="container">
                <transition name="slide-fade"> 
                    <p style="display: block;margin-left: auto;margin-right: 34%;width: 40%;" class="test" v-if="active">
                        Je suis un test 1
                    </p>
                </transition> 
                
                <div style="display: block;margin-left: auto;margin-right: auto;" v-on:mouseover="active = !active">
                <transition name="slide-fade">
                    <span v-if="active">Je suis un test 2</span>
                </transition>
                <img v-on:mouseover="active = !active" style="margin-left: auto;margin-right: auto;width: 40%;vertical-align:middle" src="http://www.led-lons-le-saunier.com/wp-content/uploads/2013/10/AMPOULE-Fotolia_48013150_XS.jpg">
                <transition name="slide-fade">
                    <span v-if="active">Je suis un test 3</span>
                </transition>
                </div>
                
                <transition name="slide-fade">
                    <p style="display: block;margin-left: auto;margin-right: 34%;width: 40%;" class="test" v-if="active">
                        Je suis un test 4
                    </p>
                </transition>
            </div>                
        <div class="container">
            <img style="width:100%" src="http://www.aviatourstunisia.com/agence-voyage-tunisie/images/beautiful_new_zealand_desktop_16_wallpaper_hd.jpg">

            <div style="width:100%;position:absolute;bottom:60px;left:0;z-index:2;">
                <div style="background-color:#FFFFFF;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;width:90%;margin:0 auto;padding:12px 0;">
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="/particuliers/vos-demarches/emmenagement" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme d&#039;un carton ouvert " title="" class="item-img">
                            <h3 class="item-title">Déménager</h3>
                        </a>
                    </div>
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="/particuliers/vos-demarches/facturation/payer-votre-facture" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme de 2 factures " title="" class="item-img">
                            <h3 class="item-title">Régler ma facture </h3>
                        </a>
                    </div>
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="/particuliers/nos-offres/electricite/offres-electricite" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme d&#039;un vue dans un cercle " title="" class="item-img">
                            <h3 class="item-title">Choisir mon électricité</h3>
                        </a>
                    </div>
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="/particuliers/consommer-mieux/reduire-vos-consommations/bonus-economies-energie" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme d&#039;une tirelire cochon " title="" class="item-img">
                            <h3 class="item-title">économiser </h3>
                        </a>
                    </div>
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="https://prive.sig-ge.ch/services/utilities/dispatcher" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme d&#039;un personnage avec un cadenas " title="" class="item-img">
                            <h3 class="item-title">Accéder à mon espace client </h3>
                        </a>
                    </div>
                    <div style="text-align:center;-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:0 10px;">
                        <a href="/particuliers/nos-offres/mobilite/electricite" class="item-link">
                            <img src="http://www.freeiconspng.com/uploads/no-image-icon-13.png" alt="pictogramme d&#039;une voiture électrique " title="" class="item-img">
                            <h3 class="item-title">Opter pour la mobilité électrique </h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                active: false

            }
        },

        created() {
            
        },
    }
</script>
