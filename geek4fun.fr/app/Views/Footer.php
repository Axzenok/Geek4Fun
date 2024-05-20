<!--- Css utile seulement pour le footer--->
<?= link_tag('/Cosplay/css/Footer2.css')?>

<br><br><br><br>
<footer id="dk-footer" class="dk-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="dk-footer-box-info">
                    <a href="index.html" class="footer-logo">
                        <!--- logo présent dans le bas de page--->
                        <?php
                        $proprieteImage = [
                            'src' => '/Cosplay/image/logo/logo.png',
                            'alt' => 'Logo',
                            'class' => 'logo'];
                        echo img($proprieteImage);
                        ?>
                    </a>
                    <div class="footer-social-link">
                        <h3><br>Projet Cosplay</h3>
                    </div>
                    <!-- End Social link -->
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-12 col-lg-8">
                <!-- End Contact Row -->
                <div class="row">
                    <!-- End col -->

                    <div class="col-md-12 col-lg-6">
                        <div class="footer-widget">
                            <div class="section-heading">
                                <h3>Liens Utiles</h3>
                                <span class="animate-border border-black"></span>
                            </div>
                            <ul>
                                <!--- lien de redirection --->
                                <li><?=anchor(base_url() . 'Cosplay/', 'Information')?></li>
                                <?php
                                //pas de session en cours
                                if (!session()->get('login')){ ?>
                                    <li><?=anchor(base_url() . 'Cosplay/Connexion', 'Connexion')?></li>
                                <?php }else{ ?>
                                    <li><?=anchor(base_url() . 'Cosplay/Deconnexion', 'Déconnexion')?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- End footer widget -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Widget Row -->
    </div>
    <!-- End Contact Container -->


    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Copyright © 2024, Tous droits réservés Team4Web</span>
                </div>
                <!-- End Col -->
                <div class="col-md-6">
                    <div class="copyright-menu">
                        <ul>
                            <li><?=anchor(base_url() . 'Cosplay/', 'Accueil')?></li>
                            <li><?=anchor(base_url() . 'Cosplay/reglementation', 'Réglementation')?></li>
                            <li><?=anchor(base_url() . 'Cosplay/Mention', 'Mention Légale')?></li>
                            <li><?=anchor(base_url() . 'Cosplay/Contact', 'Contact')?></li>
                        </ul>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Copyright Container -->
    </div>
    <!-- End Copyright -->
</footer>
</body>
</html>
