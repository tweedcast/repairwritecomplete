

const Sizing = (zoom) => {
  return {
    page: {
      p: (4.4 * zoom / 100) + 'vw',
      t: (1.2 * zoom / 100) + 'vw',
      w: (100 * zoom / 100) + '%',
      h: (129 * zoom /100) + 'vw',
    },
    header: {
      mb: (1.8 * zoom / 100) + 'vw',
      tb: (1.5 * zoom / 100) + 'vw',
      t: (1.4 * zoom / 100) + 'vw',
    },
    pageTop: {
      t: (1.4 * zoom / 100) + 'vw',
      pb: (0.8 * zoom / 100) + 'vw',
      mbl: (1 * zoom / 100) + 'vw',
      bb: (0.2 * zoom / 100) + 'vw',
      mbs: (0.6 * zoom / 100) + 'vw',
    },
    estimator: {
      mb: (1.4 * zoom / 100) + 'vw'
    },
    claimInfo: {
      mbl: (1.8 * zoom / 100) + 'vw',
      mbs: (0.4 * zoom / 100) + 'vw',
    },
    contactInfo: {
      mbl: (1.6 * zoom / 100) + 'vw',
      pb: (2.8 * zoom / 100) + 'vw',
      bb: (0.2 * zoom / 100) + 'vw',
      mbs: (0.4 * zoom / 100) + 'vw',
    },
    vehicleInfo: {
      tl: (1.4 * zoom / 100) + 'vw',
      mbl: (1.4 * zoom / 100) + 'vw',
      mbs: (0.4 * zoom / 100) + 'vw',
      pbl: (1.6 * zoom / 100) + 'vw',
      bb: (0.2 * zoom / 100) + 'vw'
    },
    vehicleDisplay: {
      mb: (1 * zoom / 100) + 'vw'
    },
    vehicleOptions: {
      p: (1.8 * zoom / 100) + 'vw',
      mbs: (0.4 * zoom / 100) + 'vw'
    },
    lineHeader: {
      bb: (0.2 * zoom / 100) + 'vw',
      bt: (0.15 * zoom / 100) + 'vw',
      p: (0.5 * zoom / 100) + 'vw',
      mt: (3.8 * zoom / 100) + 'vw',
      tl: (1.2 * zoom / 100) + 'vw',
    },
    headerLine: {
      bt: (0.2 * zoom / 100) + 'vw',
      p: (0.5 * zoom / 100) + 'vw',
      tl: (1.3 * zoom / 100) + 'vw',
    },
    childLine: {
      p: (0.5 * zoom / 100) + 'vw',
      ps: (0.3 * zoom / 100) + 'vw'
    },
    defaultLine: {
      p: (0.5 * zoom / 100) + 'vw'
    },
    suggestionLine: {
      p: (0.4 * zoom / 100) + 'vw',
      t: (1.5 * zoom / 100) + 'vw'
    },
    newSuggestion: {
      h: (2.2 * zoom / 100) + 'vw',
      pl: (2 * zoom / 100) + 'vw',
      t: (1.1 * zoom / 100) + 'vw',
      b: (0.1 * zoom / 100) + 'vw',
    },
    contextMenu: {

    },
    lineFooter: {
      mb: (1.6 * zoom / 100) + 'vw',
      bb: (0.15 * zoom / 100) + 'vw',
      bt: (0.15 * zoom / 100) + 'vw',
      p: (0.5 * zoom / 100) + 'vw'
    },
    totals: {
      bb: (0.15 * zoom / 100) + 'vw',
      mb: (0.6 * zoom / 100) + 'vw',
      mbs: (0.2 * zoom / 100) + 'vw',
      pbs: (0.1 * zoom / 100) + 'vw',
      t: (1.3 * zoom / 100) + 'vw',
    },
    totalsHeader: {
      t: (1.4 * zoom / 100) + 'vw',
      mb: (0.6 * zoom / 100) + 'vw',
      bb: (0.15 * zoom / 100) + 'vw',
      bt: (0.15 * zoom / 100) + 'vw',
    }
  }
}


export default Sizing;
