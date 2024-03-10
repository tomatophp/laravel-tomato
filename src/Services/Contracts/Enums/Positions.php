<?php

namespace TomatoPHP\LaravelTomato\Services\Contracts\Enums;

enum Positions: string
{
    case navAfterUserDropdown = "navAfterUserDropdown";
    case navBeforeUserDropdown = "navBeforeUserDropdown";
    case navLeftSide = "navLeftSide";
    case sidebarTop = "sidebarTop";
    case sidebarBottom = "sidebarBottom";
    case footer = "footer";
    case dashboardBottom = "dashboardBottom";
    case dashboardTop = "dashboardTop";
    case layoutButtons = "layoutButtons";
    case layoutTitle = "layoutTitle";
    case layoutTop  = "layoutTop";
    case layoutBottom = "layoutBottom";
    case logoSection = "logoSection";

}
