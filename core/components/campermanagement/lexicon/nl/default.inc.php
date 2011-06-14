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
$_lang['campermgmt.description'] = 'Camper &amp; Caravan voorraad module.';
$_lang['campermgmt.campers'] = 'Campers &amp; Caravans';
$_lang['campermgmt.camper'] = 'Camper';
$_lang['campermgmt.camper.new'] = 'Voeg nieuwe camper of caravan toe';
$_lang['campermgmt.camper.delete'] = 'Verwijder camper';
$_lang['campermgmt.camper.confirmdelete'] = '<p>Weet je zeker dat je deze camper wilt verwijderen? <span style="color: #ff0000">Dit kan NIET worden teruggedraaid!</span></p><p>Klik op "opslaan" om de camper permanent te verwijderen uit het systeem.</p>';
$_lang['campermgmt.owners'] = 'Eigenaren';
$_lang['campermgmt.owner'] = 'Eigenaar';
$_lang['campermgmt.owner.new'] = 'Voeg nieuwe eigenaar toe';
$_lang['campermgmt.owner.new.or'] = '... of';
$_lang['campermgmt.options'] = 'Opties';
$_lang['campermgmt.option'] = 'Optie';
$_lang['campermgmt.option.new'] = 'Voeg nieuwe optie toe';
$_lang['campermgmt.brands'] = 'Merken';
$_lang['campermgmt.brand'] = 'Merk';
$_lang['campermgmt.brand.new'] = 'Voeg nieuw merk toe';
$_lang['campermgmt.name'] = 'Naam';
$_lang['campermgmt.images'] = 'Afbeeldingen';
$_lang['campermgmt.image'] = 'Afbeelding';
$_lang['campermgmt.image.rank'] = 'Volgorde';
$_lang['campermgmt.image.upload'] = 'Upload nieuwe afbeelding';
$_lang['campermgmt.image.requiressave'] = 'Het is alleen mogelijk om afbeeldingen te uploaden wanneer het voertuig is opgeslagen.';
$_lang['campermgmt.campersaved'] = 'Voertuig succesvol opgeslagen.';
$_lang['campermgmt.error.undefined'] = 'Er is iets fout gegaan.';
$_lang['campermgmt.error.missingrequired'] = 'Vul alle verplichte velden in.';
$_lang['campermgmt.error.noid'] = 'Geen ID ontvangen.';
$_lang['campermgmt.error.id_invalid'] = 'Incorrect camper ID ontvangen.';
$_lang['campermgmt.error.status_nf'] = 'Geen nieuwe status ontvangen.';
$_lang['campermgmt.error.camper_nf'] = 'Camper met id [[+id]] kan niet gevonden worden.';
$_lang['campermgmt.error.image_nf'] = 'Afbeelding met id [[+id]] kan niet gevonden worden.';
$_lang['campermgmt.error.option_nf'] = 'Optie met id [[+id]] kan niet gevonden worden.';
$_lang['campermgmt.error.brand_nf'] = 'Merk met id [[+id]] kan niet gevonden worden.';
$_lang['campermgmt.error.brand_invalid'] = 'Geen correct merk ontvangen. Heeft u het veld ingevuld?';
$_lang['campermgmt.error.brand_undefined'] = 'Er is iets fout gegaan bij het aanmaken van een nieuw merk.';
$_lang['campermgmt.button.backtooverview'] = 'Terug naar overzicht';
$_lang['campermgmt.title.edit'] = 'Voertuig bewerken';
$_lang['campermgmt.title.new'] = 'Nieuw voertuig toevoegen';
$_lang['campermgmt.tab.general'] = 'Algemeen';
$_lang['campermgmt.tab.vehicle'] = 'Voertuig gegevens';
$_lang['campermgmt.tab.options'] = $_lang['campermgmt.options'];
$_lang['campermgmt.tab.images'] = $_lang['campermgmt.images'];
$_lang['campermgmt.status'] = 'Status';
$_lang['campermgmt.added'] = 'Toegevoegd';
$_lang['campermgmt.archived'] = 'Gearchiveerd';
$_lang['campermgmt.status.edit'] = 'Status aanpassen';
$_lang['campermgmt.status0'] = 'Niet bevestigd';
$_lang['campermgmt.status1'] = 'Actief';
$_lang['campermgmt.status2'] = 'Topper';
$_lang['campermgmt.status3'] = 'In optie';
$_lang['campermgmt.status4'] = 'Verkocht';
$_lang['campermgmt.status5'] = 'Inactief';
$_lang['campermgmt.field.price'] = 'Prijs (in &euro;)';
$_lang['campermgmt.field.key'] = 'Key';
$_lang['campermgmt.field.remarks'] = 'Opmerkingen';
$_lang['campermgmt.field.type'] = 'Type';
$_lang['campermgmt.field.plate'] = 'Kenteken';
$_lang['campermgmt.field.car'] = 'Auto';
$_lang['campermgmt.field.engine'] = 'Motor';
$_lang['campermgmt.field.manufactured'] = 'Bouwdatum';
$_lang['campermgmt.field.beds'] = 'Slaapplaatsen';
$_lang['campermgmt.field.weight'] = 'Gewicht';
$_lang['campermgmt.field.mileage'] = 'Kilometerstand';
$_lang['campermgmt.field.periodiccheck'] = 'APK datum';
$_lang['campermgmt.field.id'] = '#';
$_lang['campermgmt.field.firstname'] = 'Voornaam';
$_lang['campermgmt.field.lastname'] = 'Achternaam';
$_lang['campermgmt.field.address'] = 'Adres';
$_lang['campermgmt.field.city'] = 'Plaats';
$_lang['campermgmt.field.postal'] = 'Postcode';
$_lang['campermgmt.field.email'] = 'Email';
$_lang['campermgmt.field.phone1'] = 'Telefoon (1)';
$_lang['campermgmt.field.phone2'] = 'Telefoon (2)';
$_lang['campermgmt.field.country'] = 'Land';
$_lang['campermgmt.field.country.default'] = 'Nederland';
$_lang['campermgmt.field.bank'] = 'Rekeningnummer';
$_lang['campermgmt.pdf.window'] = 'Genereer raambiljet';
$_lang['campermgmt.showarchived'] = 'Bekijk gearchiveerde voertuigen';
$_lang['campermgmt.hidearchived'] = 'Bekijk actieve voertuigen';

?>
