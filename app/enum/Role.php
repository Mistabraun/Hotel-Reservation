<?php

enum Role: int
{
    case SUPER_ADMIN = 1;
    case ADMIN = 2;
    case CUSTOMER = 3;
    case MANAGER = 4;
}
