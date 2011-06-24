<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/caravan inventory management
 * addon for MODX Revolution.
 *
 * CamperManagement is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CamperManagement is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CamperManagement; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 */

$_lang['campermgmt'] = 'Camper Management';
$_lang['campermgmt.description'] = 'Gestion de camping-cars &amp; de caravanes.';
$_lang['campermgmt.campers'] = 'Camping-cars &amp; caravanes';
$_lang['campermgmt.camper'] = 'Camping-cars';
$_lang['campermgmt.camper.new'] = 'Ajouter un nouveau camping-car ou caravane';
$_lang['campermgmt.camper.delete'] = 'Supprimer le camping-car';
$_lang['campermgmt.camper.confirmdelete'] = '<p>Êtes-vous sûr de vouloir supprimer ce camping-car du système ?? <span style="color: #ff0000">Cette opération est irréversible!</span></p><p>Choisissez « sauvegarder » pour supprimer ce véhicule.</p>';
$_lang['campermgmt.owners'] = 'Propriétaires';
$_lang['campermgmt.owner'] = 'Propriétaire';
$_lang['campermgmt.owner.new'] = 'Ajouter un nouveau propriétaire';
$_lang['campermgmt.owner.new.or'] = '... ou';
$_lang['campermgmt.options'] = 'Options';
$_lang['campermgmt.option'] = 'Option';
$_lang['campermgmt.option.new'] = 'Ajouter une nouvelle option';
$_lang['campermgmt.brands'] = 'Marques';
$_lang['campermgmt.brand'] = 'Marque';
$_lang['campermgmt.brand.new'] = 'Ajouter une nouvelle marque';
$_lang['campermgmt.name'] = 'Nom';
$_lang['campermgmt.images'] = 'Images';
$_lang['campermgmt.image'] = 'Image';
$_lang['campermgmt.image.rank'] = 'Position';
$_lang['campermgmt.image.upload'] = 'Uploader de nouvelles images';
$_lang['campermgmt.image.requiressave'] = 'Il est possible d\'uploader des images seulement après avoir sauvegardé une première fois le véhicule.';
$_lang['campermgmt.campersaved'] = 'Sauvegarde du véhicule réussie.';
$_lang['campermgmt.error.undefined'] = 'Une erreur est survenue.';
$_lang['campermgmt.error.missingrequired'] = 'Veuillez renseigner tous les champs requis du formulaire.';
$_lang['campermgmt.error.noid'] = 'ID non trouvé.';
$_lang['campermgmt.error.id_invalid'] = 'ID de véhicule incorrecte.';
$_lang['campermgmt.error.status_nf'] = 'Pas de nouveau status trouvé.';
$_lang['campermgmt.error.camper_nf'] = 'Aucun véhicule ayant pour ID [[+id]] trouvé.';
$_lang['campermgmt.error.image_nf'] = 'Aucune image ayant pour ID [[+id]] trouvé.';
$_lang['campermgmt.error.option_nf'] = 'Aucune option ayant pour ID [[+id]] trouvé.';
$_lang['campermgmt.error.brand_nf'] = 'Aucune marque ayant pour ID [[+id]] trouvé.';
$_lang['campermgmt.error.brand_invalid'] = 'Marque invalide. Avez-vous correctement renseigné le champ ?';
$_lang['campermgmt.error.brand_undefined'] = 'Une erreur est survenue lors de la sauvegarde de la marque.';
$_lang['campermgmt.error.select_image'] = 'Veuillez sélectionner une image avant d\'utiliser le clic droit.';
$_lang['campermgmt.button.backtooverview'] = 'Retour à l\'aperçu';
$_lang['campermgmt.title.edit'] = 'Éditer le véhicule';
$_lang['campermgmt.title.new'] = 'Ajouter un nouveau véhicule';
$_lang['campermgmt.tab.general'] = 'Général';
$_lang['campermgmt.tab.vehicle'] = 'Détails du véhicule';
$_lang['campermgmt.tab.options'] = $_lang['campermgmt.options'];
$_lang['campermgmt.tab.images'] = 'Images';
$_lang['campermgmt.status'] = 'Status';
$_lang['campermgmt.added'] = 'Ajouté';
$_lang['campermgmt.archived'] = 'Archivé';
$_lang['campermgmt.status.edit'] = 'Mettre à jour le status';
$_lang['campermgmt.status0'] = 'Non confirmé';
$_lang['campermgmt.status1'] = 'Disponible';
$_lang['campermgmt.status2'] = 'Favoris';
$_lang['campermgmt.status3'] = 'Vendu sous condition(s)';
$_lang['campermgmt.status4'] = 'Vendu';
$_lang['campermgmt.status5'] = 'Non disponible';
$_lang['campermgmt.field.price'] = 'Prix (en &euro;)';
$_lang['campermgmt.field.key'] = 'Numéro/jeu de clé';
$_lang['campermgmt.field.remarks'] = 'Remarques';
$_lang['campermgmt.field.type'] = 'Type';
$_lang['campermgmt.field.plate'] = 'Plaque d\'immatriculation';
$_lang['campermgmt.field.car'] = 'Voiture';
$_lang['campermgmt.field.engine'] = 'Motorisation';
$_lang['campermgmt.field.manufactured'] = 'Année de construction';
$_lang['campermgmt.field.beds'] = 'Lits';
$_lang['campermgmt.field.weight'] = 'Poids';
$_lang['campermgmt.field.mileage'] = 'Kilométrage';
$_lang['campermgmt.field.periodiccheck'] = 'Contrôle technique';
$_lang['campermgmt.field.id'] = '#';
$_lang['campermgmt.field.firstname'] = 'Prénom';
$_lang['campermgmt.field.lastname'] = 'Nom';
$_lang['campermgmt.field.address'] = 'Adresse';
$_lang['campermgmt.field.city'] = 'Ville';
$_lang['campermgmt.field.postal'] = 'Code postal';
$_lang['campermgmt.field.email'] = 'E-mail';
$_lang['campermgmt.field.phone1'] = 'Téléphone (1)';
$_lang['campermgmt.field.phone2'] = 'Téléphone (2)';
$_lang['campermgmt.field.country'] = 'Pays';
$_lang['campermgmt.field.country.default'] = 'France';
$_lang['campermgmt.field.bank'] = 'Banque';
$_lang['campermgmt.ctxmenu1'] = 'Générer la fiche';
$_lang['campermgmt.ctxmenu2'] = 'Générer le contrat';
$_lang['campermgmt.overview'] = 'Générer la fiche d\'inventaire';
$_lang['campermgmt.showarchived'] = 'Voir les véhicules archivés';
$_lang['campermgmt.hidearchived'] = 'Voir les véhicules actifs';


?>
