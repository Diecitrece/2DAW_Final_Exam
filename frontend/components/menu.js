import React, { useEffect, useState } from 'react';
import styles from '../styles/Menu.module.css';

export default function Menu()
{

  const [mainWeather, setMainWeather] = useState();
  const [descriptionWeather, setWeatherDescription] = useState();
  const [iconWeather, setWeatherIcon] = useState();
  const [isLoading, setLoading] = useState(true);
  useEffect(() =>
    {
      let url=process.env.apiRoute + '/weather';
      const response = fetch(url, 
      {
          method: "GET",
      })
      .then(response => response.json())
      .then(data =>
          {
              setLoading(false);
              setMainWeather(data["main"]);
              setWeatherDescription(data["description"]);
              let icon = "http://openweathermap.org/img/wn/"+ data["icon"] +"@4x.png";
              setWeatherIcon(icon);
          })
      .catch(error => console.log(error));
    }, []);

  if(isLoading)
  {
    return (
      <div className={styles.menu}>
          <div className={styles.logo}>
            <img src='/logo.png'></img>
          </div>
          <div id="WeatherSection" className={styles.weatherSection}>
            <div className='loading'>
              <i className="fas fa-spinner" id='spinner'></i>
            </div>
          </div>
          <div className={styles.menuSection} onClick={e => (window.location = "/")}>
            <i className="far fa-newspaper"></i>Home  ||  News
          </div>
          <div className={styles.menuSection} onClick={e => (window.location = "/restaurants")}>
            <i className="fas fa-utensils"></i>Restaurants
          </div>
          <div className={styles.menuSection} onClick={e => (window.location = "/gas_stations")}>
            <i className="fas fa-gas-pump"></i>Gas Stations
          </div>
          <div className={styles.menuSection} onClick={e => (window.location = "/videos")}>
            <i className="fas fa-video"></i>Videos
          </div>
      </div>
    );
  }
    return (
    <div className={styles.menu}>
        <div className={styles.logo}>
          <img src='/logo.png'></img>
        </div>
        <div id="WeatherSection" className={styles.weatherSection} onClick={() => {window.open('https://openweathermap.org/city/2519752')}}>
          <img src={iconWeather}/><div><span className='underline font-bold'>Description</span> {descriptionWeather}</div>
        </div>
        <div className={styles.menuSection} onClick={e => (window.location = "/")}>
          <i className="far fa-newspaper"></i>Home  ||  News
        </div>
        <div className={styles.menuSection} onClick={e => (window.location = "/restaurants")}>
          <i className="fas fa-utensils"></i>Restaurants
        </div>
        <div className={styles.menuSection} onClick={e => (window.location = "/gas_stations")}>
          <i className="fas fa-gas-pump"></i>Gas Stations
        </div>
        <div className={styles.menuSection} onClick={e => (window.location = "/videos")}>
          <i className="fas fa-video"></i>Videos
        </div>
    </div>
  );
}