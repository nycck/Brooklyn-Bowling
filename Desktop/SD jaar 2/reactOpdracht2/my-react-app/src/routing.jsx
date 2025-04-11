import React from "react";
import { Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import News from "./pages/news";
import Contact from "./pages/Contact";

const Routing = () => {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/news" element={<News />} />
      <Route path="/contact" element={<Contact />} />
    </Routes>
  );
};

export default Routing;