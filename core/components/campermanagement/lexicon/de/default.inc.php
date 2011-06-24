<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/Wohnmobil inventory management
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
$_lang['campermgmt.description'] = 'Camper &amp; Wohnmobil Bestandsaufnahme-Management.';
$_lang['campermgmt.campers'] = 'Campers &amp; Wohnmobils';
$_lang['campermgmt.camper'] = 'Camper';
$_lang['campermgmt.camper.new'] = 'Füge neuen Camper oder Wohnmobil hinzu';
$_lang['campermgmt.camper.delete'] = 'Entferne Camper';
$_lang['campermgmt.camper.confirmdelete'] = '<p>Sind Sie sicher, dass Sie diesen Camper aus dem System entfernen möchten? <span style="color: #ff0000">Dieser Schritt kann nicht rückgängig gemacht werden!</span></p><p>Wählen Sie "Speichern" um das Fahrzeug zu entfernen.</p>';
$_lang['campermgmt.owners'] = 'Eigentümer';
$_lang['campermgmt.owner'] = 'Eigentümer';
$_lang['campermgmt.owner.new'] = 'Füge neuen Eigentümer hinzu';
$_lang['campermgmt.owner.new.or'] = '... oder';
$_lang['campermgmt.options'] = 'Optionen';
$_lang['campermgmt.option'] = 'Option';
$_lang['campermgmt.option.new'] = 'Füge neue Option hinzu';
$_lang['campermgmt.brands'] = 'Marken';
$_lang['campermgmt.brand'] = 'Marke';
$_lang['campermgmt.brand.new'] = 'Füge neue Marke hinzu';
$_lang['campermgmt.name'] = 'Name';
$_lang['campermgmt.images'] = 'Bilder';
$_lang['campermgmt.image'] = 'Bild';
$_lang['campermgmt.image.rank'] = 'Rang';
$_lang['campermgmt.image.upload'] = 'Füge neue bilder hinzu';
$_lang['campermgmt.image.requiressave'] = 'Es ist nur möglich Bilder hinzuzufügen, nachdem das Fahrzeug erstmals gespeichert wurde.';
$_lang['campermgmt.campersaved'] = 'Fahrzeug wurde erfolgreich gespeichert.';
$_lang['campermgmt.error.undefined'] = 'Leider ist etwas schiefgelaufen.';
$_lang['campermgmt.error.missingrequired'] = 'Bitte füllen Sie alle benötigten Felder im Formular aus.';
$_lang['campermgmt.error.noid'] = 'Es wurde keine ID gefunden.';
$_lang['campermgmt.error.id_invalid'] = 'Ungültige Fahrzeug-ID.';
$_lang['campermgmt.error.status_nf'] = 'Es wurde kein neues Status gefunden.';
$_lang['campermgmt.error.camper_nf'] = 'Es wurde kein Fahrzeug mit der ID [[+id]] gefunden.';
$_lang['campermgmt.error.image_nf'] = 'Es wurde kein Bild mit der ID [[+id]] gefunden.';
$_lang['campermgmt.error.option_nf'] = 'Es wurde keine Option mit der ID [[+id]] gefunden.';
$_lang['campermgmt.error.brand_nf'] = 'Es wurde keine Marke mit der ID [[+id]] gefunden.';
$_lang['campermgmt.error.brand_invalid'] = 'Ungültige Marke gefunden. Haben Sie das Feld korrekt angegeben?';
$_lang['campermgmt.error.brand_undefined'] = 'Es trat ein Fehler beim Speichern der Marke auf.';
$_lang['campermgmt.error.select_image'] = 'Bitten wählen Sie ein Bild aus.';
$_lang['campermgmt.button.backtooverview'] = 'zurück zur Übersicht';
$_lang['campermgmt.title.edit'] = 'Fahrzeug bearbeiten';
$_lang['campermgmt.title.new'] = 'neues Fahrzeug hinzufügen';
$_lang['campermgmt.tab.general'] = 'Allgemein';
$_lang['campermgmt.tab.vehicle'] = 'Feahrzeugdetails';
$_lang['campermgmt.tab.options'] = $_lang['campermgmt.options'];
$_lang['campermgmt.tab.images'] = 'Bilder';
$_lang['campermgmt.status'] = 'Status';
$_lang['campermgmt.added'] = 'hinzugefügt';
$_lang['campermgmt.archived'] = 'archiviert';
$_lang['campermgmt.status.edit'] = 'Statusupdate';
$_lang['campermgmt.status0'] = 'nicht bestätigt';
$_lang['campermgmt.status1'] = 'aktiv';
$_lang['campermgmt.status2'] = 'Favorit';
$_lang['campermgmt.status3'] = 'unter Vorbehalt verkauft';
$_lang['campermgmt.status4'] = 'verkauft';
$_lang['campermgmt.status5'] = 'inaktiv';
$_lang['campermgmt.field.price'] = 'Preis (in &euro;)';
$_lang['campermgmt.field.key'] = 'Schlüssel';
$_lang['campermgmt.field.remarks'] = 'Hinweis';
$_lang['campermgmt.field.type'] = 'Typ';
$_lang['campermgmt.field.plate'] = 'Kennzeichen';
$_lang['campermgmt.field.car'] = 'Fahrzeug';
$_lang['campermgmt.field.engine'] = 'Motor';
$_lang['campermgmt.field.manufactured'] = 'hergestellt';
$_lang['campermgmt.field.beds'] = 'Betten';
$_lang['campermgmt.field.weight'] = 'Gewicht';
$_lang['campermgmt.field.mileage'] = 'Kilometerleistung';
$_lang['campermgmt.field.periodiccheck'] = 'Service-Check';
$_lang['campermgmt.field.id'] = '#';
$_lang['campermgmt.field.firstname'] = 'Vorname';
$_lang['campermgmt.field.lastname'] = 'Nachname';
$_lang['campermgmt.field.address'] = 'Adresse';
$_lang['campermgmt.field.city'] = 'Ort';
$_lang['campermgmt.field.postal'] = 'PLZ';
$_lang['campermgmt.field.email'] = 'E-Mail';
$_lang['campermgmt.field.phone1'] = 'Telefon (1)';
$_lang['campermgmt.field.phone2'] = 'Mobil (2)';
$_lang['campermgmt.field.country'] = 'Land';
$_lang['campermgmt.field.country.default'] = 'Deutschland';
$_lang['campermgmt.field.bank'] = 'Bank';
$_lang['campermgmt.ctxmenu1'] = 'Erstelle Produktdatenblatt';
$_lang['campermgmt.ctxmenu2'] = 'Erstelle Vertrag';
$_lang['campermgmt.overview'] = 'Erstelle Inventurblatt';
$_lang['campermgmt.showarchived'] = 'Zeige archivierte Fahrzeuge';
$_lang['campermgmt.hidearchived'] = 'Zeige aktive Fahrzeuge';


?>
