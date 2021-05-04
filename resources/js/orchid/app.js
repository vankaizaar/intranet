import { Application, Controller } from 'stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';
import platform from "./platform";

global.$ = global.jQuery = require('jquery');

window.Popper = require('popper.js');
require('bootstrap');
require('select2');

import { Calendar } from '@fullcalendar/core';
import dayGrid from '@fullcalendar/daygrid';
import interaction from '@fullcalendar/interaction';
import timeGrid from '@fullcalendar/timegrid';
import list from '@fullcalendar/list';
import Tooltip from 'tooltip.js';


window.platform = platform();
window.application = Application.start();
window.Controller = Controller;

window.Calendar = Calendar;
window.dayGrid = dayGrid;
window.interaction = interaction;
window.timeGrid = timeGrid;
window.list = list;
window.Tooltip = Tooltip;

const context = require.context('./controllers', true, /\.js$/);
application.load(definitionsFromContext(context));
