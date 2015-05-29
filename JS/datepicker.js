$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
      closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
      prevText: '&lt;Pr�c', prevStatus: 'Voir le mois pr�c�dent',
      nextText: 'Suiv&gt;', nextStatus: 'Voir le mois suivant',
      currentText: 'Courant', currentStatus: 'Voir le mois courant',
      monthNames: ['Janvier','F�vrier','Mars','Avril','Mai','Juin',
      'Juillet','Ao�t','Septembre','Octobre','Novembre','D�cembre'],
      monthNamesShort: ['Jan','F�v','Mar','Avr','Mai','Jun',
      'Jul','Ao�','Sep','Oct','Nov','D�c'],
      monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre ann�e',
      weekHeader: 'Sm', weekStatus: '',
      dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
      dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
      dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
      dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
      dateFormat: 'dd/mm/yy', firstDay: 1, 
      initStatus: 'Choisir la date', isRTL: false};
   $.datepicker.setDefaults($.datepicker.regional['fr']);
  		$(function() {
  			$("#datepicker").datepicker();
  		});