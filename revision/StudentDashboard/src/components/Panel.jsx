function Panel({ title, subtitle }) {
  return (
    <div className="panel">
      <h3 className="panel-title">{title}</h3>
      <p className="panel-subtitle">{subtitle}</p>
      <button className="go-btn">Go</button>
    </div>
  );
}

export default Panel;
