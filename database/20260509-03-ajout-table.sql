create table user_regime(
    id int primary key AUTO_INCREMENT,
    id_user_health_info int,
    id_regime int,
    id_sport int,
    date_commande datetime,
    duree int,
    prix decimal(10.2),
    foreign key (id_user_health_info) REFERENCES user_health_info(id),
    foreign key (id_regime) REFERENCES regime(id),
    foreign key (id_sport) REFERENCES sport(id)
);