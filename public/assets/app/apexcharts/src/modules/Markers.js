import Filters from './Filters'
import Graphics from './Graphics'
import Utils from '../utils/Utils'

/**
 * ApexCharts Markers Class for drawing markers on y values in axes charts.
 *
 * @module Markers
 **/

export default class Markers {
  constructor(ctx, opts) {
    this.ctx = ctx
    this.w = ctx.w
  }

  setGlobalMarkerSize() {
    const w = this.w

    w.globals.markers.size = Array.isArray(w.config.markers.size)
      ? w.config.markers.size
      : [w.config.markers.size]

    if (w.globals.markers.size.length > 0) {
      if (w.globals.markers.size.length < w.globals.series.length + 1) {
        for (let i = 0; i <= w.globals.series.length; i++) {
          if (typeof w.globals.markers.size[i] === 'undefined') {
            w.globals.markers.size.push(w.globals.markers.size[0])
          }
        }
      }
    } else {
      w.globals.markers.size = w.config.series.map((s) => w.config.markers.size)
    }
  }

  plotChartMarkers({
    pointsPos,
    seriesIndex,
    j,
    pSize,
    alwaysDrawMarker = false,
    isVirtualPoint = false,
  }) {
    let w = this.w

    let i = seriesIndex
    let p = pointsPos
    let elMarkersWrap = null

    let graphics = new Graphics(this.ctx)

    const hasDiscreteMarkers =
      w.config.markers.discrete && w.config.markers.discrete.length

    if (Array.isArray(p.x)) {
      for (let q = 0; q < p.x.length; q++) {
        let markerElement

        let dataPointIndex = j
        let invalidMarker = !Utils.isNumber(p.y[q])

        if (
          w.globals.markers.largestSize === 0 &&
          w.globals.hasNullValues &&
          w.globals.series[i][j + 1] !== null &&
          !isVirtualPoint
        ) {
          invalidMarker = true
        }

        // a small hack as we have 2 points for the first val to connect it
        if (j === 1 && q === 0) dataPointIndex = 0
        if (j === 1 && q === 1) dataPointIndex = 1

        let markerClasses = 'apexcharts-marker'
        if (
          (w.config.chart.type === 'line' || w.config.chart.type === 'area') &&
          !w.globals.comboCharts &&
          !w.config.tooltip.intersect
        ) {
          markerClasses += ' no-pointer-events'
        }

        const shouldMarkerDraw = Array.isArray(w.config.markers.size)
          ? w.globals.markers.size[seriesIndex] > 0
          : w.config.markers.size > 0

        if (shouldMarkerDraw || alwaysDrawMarker || hasDiscreteMarkers) {
          if (!invalidMarker) {
            markerClasses += ` w${Utils.randomId()}`
          }

          let opts = this.getMarkerConfig({
            cssClass: markerClasses,
            seriesIndex,
            dataPointIndex,
          })

          if (w.config.series[i].data[dataPointIndex]) {
            if (w.config.series[i].data[dataPointIndex].fillColor) {
              opts.pointFillColor =
                w.config.series[i].data[dataPointIndex].fillColor
            }

            if (w.config.series[i].data[dataPointIndex].strokeColor) {
              opts.pointStrokeColor =
                w.config.series[i].data[dataPointIndex].strokeColor
            }
          }

          if (typeof pSize !== 'undefined') {
            opts.pSize = pSize
          }

          if (
            p.x[q] < -w.globals.markers.largestSize ||
            p.x[q] > w.globals.gridWidth + w.globals.markers.largestSize ||
            p.y[q] < -w.globals.markers.largestSize ||
            p.y[q] > w.globals.gridHeight + w.globals.markers.largestSize
          ) {
            opts.pSize = 0
          }

          if (!invalidMarker) {
            const shouldCreateMarkerWrap =
              w.globals.markers.size[seriesIndex] > 0 ||
              alwaysDrawMarker ||
              hasDiscreteMarkers
            if (shouldCreateMarkerWrap && !elMarkersWrap) {
              elMarkersWrap = graphics.group({
                class:
                  alwaysDrawMarker || hasDiscreteMarkers
                    ? ''
                    : 'apexcharts-series-markers',
              })
              elMarkersWrap.attr(
                'clip-path',
                `url(#gridRectMarkerMask${w.globals.cuid})`
              )
            }
            markerElement = graphics.drawMarker(p.x[q], p.y[q], opts)

            markerElement.attr('rel', dataPointIndex)
            markerElement.attr('j', dataPointIndex)
            markerElement.attr('index', seriesIndex)
            markerElement.node.setAttribute('default-marker-size', opts.pSize)

            const filters = new Filters(this.ctx)
            filters.setSelectionFilter(
              markerElement,
              seriesIndex,
              dataPointIndex
            )
            this.addEvents(markerElement)

            if (elMarkersWrap) {
              elMarkersWrap.add(markerElement)
            }
          }
        } else {
          // dynamic array creation - multidimensional
          if (typeof w.globals.pointsArray[seriesIndex] === 'undefined')
            w.globals.pointsArray[seriesIndex] = []

          w.globals.pointsArray[seriesIndex].push([p.x[q], p.y[q]])
        }
      }
    }

    return elMarkersWrap
  }

  getMarkerConfig({
    cssClass,
    seriesIndex,
    dataPointIndex = null,
    radius = null,
    size = null,
    strokeWidth = null,
  }) {
    const w = this.w
    let pStyle = this.getMarkerStyle(seriesIndex)
    let pSize = size === null ? w.globals.markers.size[seriesIndex] : size

    const m = w.config.markers

    // discrete markers is an option where user can specify a particular marker with different shape, size and color

    if (dataPointIndex !== null && m.discrete.length) {
      m.discrete.map((marker) => {
        if (
          marker.seriesIndex === seriesIndex &&
          marker.dataPointIndex === dataPointIndex
        ) {
          pStyle.pointStrokeColor = marker.strokeColor
          pStyle.pointFillColor = marker.fillColor
          pSize = marker.size
          pStyle.pointShape = marker.shape
        }
      })
    }

    return {
      pSize: radius === null ? pSize : radius,
      pRadius: radius !== null ? radius : m.radius,
      pointStrokeWidth:
        strokeWidth !== null
          ? strokeWidth
          : Array.isArray(m.strokeWidth)
          ? m.strokeWidth[seriesIndex]
          : m.strokeWidth,
      pointStrokeColor: pStyle.pointStrokeColor,
      pointFillColor: pStyle.pointFillColor,
      shape:
        pStyle.pointShape ||
        (Array.isArray(m.shape) ? m.shape[seriesIndex] : m.shape),
      class: cssClass,
      pointStrokeOpacity: Array.isArray(m.strokeOpacity)
        ? m.strokeOpacity[seriesIndex]
        : m.strokeOpacity,
      pointStrokeDashArray: Array.isArray(m.strokeDashArray)
        ? m.strokeDashArray[seriesIndex]
        : m.strokeDashArray,
      pointFillOpacity: Array.isArray(m.fillOpacity)
        ? m.fillOpacity[seriesIndex]
        : m.fillOpacity,
      seriesIndex,
    }
  }

  addEvents(marker) {
    const w = this.w

    const graphics = new Graphics(this.ctx)
    marker.node.addEventListener(
      'mouseenter',
      graphics.pathMouseEnter.bind(this.ctx, marker)
    )
    marker.node.addEventListener(
      'mouseleave',
      graphics.pathMouseLeave.bind(this.ctx, marker)
    )

    marker.node.addEventListener(
      'mousedown',
      graphics.pathMouseDown.bind(this.ctx, marker)
    )

    marker.node.addEventListener('click', w.config.markers.onClick)
    marker.node.addEventListener('dblclick', w.config.markers.onDblClick)

    marker.node.addEventListener(
      'touchstart',
      graphics.pathMouseDown.bind(this.ctx, marker),
      { passive: true }
    )
  }

  getMarkerStyle(seriesIndex) {
    let w = this.w

    let colors = w.globals.markers.colors
    let strokeColors =
      w.config.markers.strokeColor || w.config.markers.strokeColors

    let pointStrokeColor = Array.isArray(strokeColors)
      ? strokeColors[seriesIndex]
      : strokeColors
    let pointFillColor = Array.isArray(colors) ? colors[seriesIndex] : colors

    return {
      pointStrokeColor,
      pointFillColor,
    }
  }
}
